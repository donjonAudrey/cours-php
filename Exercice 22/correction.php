<?php
//Appel des variables

if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmPassword'])


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
        $checkIfExists = $bdd->prepare('SELECT * FROM accounts WHERE email = ?');

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
            $addUser = $bdd->prepare('INSERT INTO accounts(email, password,register_date) VALUES(?, ?, ?)');

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
        <title>Correction : Exercice 22</title>
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
            <form action="correction.php" method="POST">
                <input type="text" placeholder="Email" name="email">
                <input type="password" placeholder="Mot de passe" name="password">
                <input type="password" placeholder="Confirmation de mot de passe" name="confirmPassword">
                <input type="submit">
            </form>
            <?php
            }
            ?>
    </body>
</html>