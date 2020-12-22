<?php

//1er étape : Appel des variables
if (
        isset($_POST['email'])&&
        isset($_POST['password'])&&
        isset($_POST['confirmPassword'])
){
//2ème étape : Bloc des verifs

    //Vérification de l'adresse mail
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = "Ton mail doit être valide";
    }

    //Vérification du mot de passe
    if (!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/', $_POST['password'])){
        $errors[] = "Ton mot de passe doit contenir entre 8 et 4096 caractères";
    }

    //Vérification de la confirmation de mot de passe
    if ($_POST['confirmPassword'] != $_POST['password']){
        $errors[] = "Ta confirmation de mot de passe n'est pas la même que ton mot de passe";
    }

//3ème étape : Si pas d'erreurs
    if(!isset($errors)){
        $registerDate = new DateTime();
        // Connexion à la bdd
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
            $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die('Problème avec la bdd : ' . $e->getMessage());
        }

        // Requête préparée pour créer le nouveau fruit (requête préparée car il y a des variables PHP à mettre dedans, donc on se protège des injections SQL)
        $response = $bdd->prepare("INSERT INTO accounts(email, password,register_date) VALUES(?, ?, ?)");

        // Execution de la requête en liant les 3 marqueurs à leurs variables PHP
        $response->execute([
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_BCRYPT),
            $registerDate->format('Y-m-d H:i:s'),
        ]);

        // Si rowCount renvoi plus de 0, alors l'insertion a fonctionné, sinon erreur
        if($response->rowCount() > 0){
            $successMsg = '<p class="valid">Votre inscription a bien été enregistré !</p>';
        } else {
            $errors[] = 'Problème interne au site veuillez ré-essayer plus tard';
        }

        // Fermeture de la requête
        $response->closeCursor();
    }

}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 22 : formulaire d'inscription</title>
        <style>
            h1{
                text-align: center;
            }
            p{
                font-size: 2rem;
                font-family: "Roboto, Arial";
                text-align: center;
            }
            .error{
                color: darkred;
                font-weight: bold;
            }
            .valid{
                color: #7ec699;
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
        //Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
        if (isset($errors)){
            foreach ($errors as $error){
                echo '<p class="error">' . $error . '</p>';
            }
        }
        //Si la variable $succssMsg existe, alors on l'affiche, sinon on affiche le formulaire dans le else
        if (isset($successMsg)){
            echo '<p class="valid">' . $successMsg . '</p>';
        }else{
            ?>
            <h1>Formulaire d'inscription</h1>
            <form action="register.php" method="POST">
                <div>
                    <label for="email">Adresse mail :</label>
                    <input type="text" name="email" placeholder="alice@mail.fr">
                </div>
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <label for="confirmPassword">Confirmation de passe :</label>
                    <input type="password" name="confirmPassword">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
            <?php
        }
        ?>

    </body>
</html>