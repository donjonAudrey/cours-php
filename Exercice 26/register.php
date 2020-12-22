<?php

//Inclusion de la fonction permettant de vérifier si le captcha est valide ou pas.
require 'recaptchaValid.php';

//Appel des variables

if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmPassword']) &&
    isset($_POST['g-recaptcha-response'])

){
    //Bloc des verifs

    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email invalide";
    }

    if (!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/', $_POST['password'])){
        $errors[] = "Ton mot de passe doit contenir au moins 8 carractères dont une minuscule, une majuscule, un chiffre et un caractère spécial !";
    }

    if ($_POST['password'] != $_POST['confirmPassword']){
        $errors[] = "La confirmation ne corresponds pas au mot de passe";
    }
    //Vérification du captcha
    if(!recaptchaValid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])){
        $errors[] = 'Veuillez remplir correctement le captcha !';
    }

    //Si pas d'erreurs
    if (!isset($errors)){

        // Second bloc de vérif (si email pas déjà pris)

        //Connexion à la bdd
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
            $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die('Problème avec la bdd : ' . $e->getMessage());
        }

        //Pour vérifier si le compte existe, il suffit de faire un select avec l'email
        $checkIfExists = $bdd->prepare('SELECT * FROM users WHERE email = ?');

        $checkIfExists->execute([
            $_POST['email']
        ]);

        $account = $checkIfExists->fetch(PDO::FETCH_ASSOC);

        //Si account n'est pas vide, ça veux dire qu'un compte a été trouvé, donc message d'erreur
        if (!empty($account)){
            $errors[] = 'Cette adresse mail est déjà utilisé !';
        }

        //Si pas d'erreurs
        if (!isset($errors)){

            // Requête préparée pour créer le nouveau compte (requête préparée car il y a des variables PHP à mettre dedans, donc on se protège des injections SQL)
            $addUser = $bdd->prepare('INSERT INTO users(email, password,register_date) VALUES(?, ?, ?)');

            // Execution de la requête en liant les 3 marqueurs à leurs variables PHP
            $statut = $addUser->execute([
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT),//mot de passe hasher en Bcrypt
                date('Y-m-d H:i:s'), //date actuel à stocker au moment de l'execution
            ]);

            // Fermeture de la requête
            $addUser->closeCursor();

            // Si ça a bien fonctionné

            if($statut){
                $success = 'Votre compte a bien été crééé !';
            }else{
                $errors[] = 'Problème interne au site veuillez ré-essayer plus tard';
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RECAPTCHA</title>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <style>
            h1{
                text-align: center;
            }
            p{
                font-size: 2rem;
                font-family: "Roboto, Arial";
                text-align: center;
            }
            form>div{
                display: flex;
                flex-direction: column;
                margin: 1em;
                align-items: center;
            }
            form{
                margin-top: 2rem;
                border: #2d2d2d solid 2px;
                width:80%;
                margin: auto;
                font-size: 2rem;
            }

        </style>
    </head>
    <body>
        <?php
            //Si $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
            if (isset($errors)){
                foreach ($errors as $error){
                    echo '<p style="color: darkred;">' . $error . '</p>';
                }
            }
            //Si la variable $succss existe, alors on l'affiche, sinon on affiche le formulaire dans le else
            if (isset($success)){
                echo '<p style="color: darkgreen">' . $success . '</p>';
            }else{
        ?>
            <h1>Formulaire d'inscription</h1>
            <form action="register.php" method="POST">
                <div>
                    <label for="email">Votre email :</label>
                    <input type="text" placeholder="arthur@gmail.com" name="email">
                </div>
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" placeholder="Mot de passe" name="password">
                </div>
                <div>
                    <label for="confirmPassword">Confirmation de mot de passe :</label>
                    <input type="password" placeholder="Mot de passe" name="confirmPassword">
                </div>
                <div class="g-recaptcha" data-sitekey="6LeGihAaAAAAAGMfnJm51TegZ_TauZg6rpBQfmBN"></div>
                <div>
                    <input type="submit">
                </div>
            </form>
            <?php
            }
            ?>
    </body>
</html>