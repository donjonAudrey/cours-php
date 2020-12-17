<?php
//1ere étape : Appel des variables
if (isset($_POST['email']) &&
    isset($_POST['pseudo']) &&
    isset($_POST['password']) &&
    isset($_POST['birthdate'])
){
//2ème étape : bloc des vérifs

    //Vérification du mail
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ton mail doit être valide";
    }
    //Vérification du pseudo
    if (!preg_match('/^[a-z0-9_\'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{2,25}$/i', $_POST['pseudo'])){
        $errors[] = "Ton pseudo doit contenir entre 2 et 25 caractères";
    }

    //Vérification du mot de passe
    if (!preg_match('/^.{8,4096}$/', $_POST['password'])){
        $errors[] = "Ton mot de passe doit contenir entre 8 et 4096 caractères";
    }
    //Vérification de la date de naissance
    if (!preg_match('/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/', $_POST['birthdate'])){
       $errors[] = "Votre date doit respecter le format standards et en français";
    }

    //3ème étape : Si le formulaire n'a pas d'érreur, on fait les actions post-formulaire
    if (!isset($errors)){
        //Création du message de succès
        $successMsg = "Votre compte a bien été créé !";
    }


}

?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 19 : formulaire avec des REGEX</title>
        <style>
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
            input{
                width: 200px;
            }
        </style>
    </head>
    <body>
        <?php
        //Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les errreurs qu'il contient
        if (isset($errors)){
            foreach ($errors as $error){
                echo '<p class="error">' . $error . '</p>';
            }
        }
        //Si la variable $successMsg existe, alors on l'affiche, sinon on affiche le formulaire dans le else

        if (isset($successMsg)){
            echo '<p class="valid">' . $successMsg . '</p>';
        }else{
            ?>
            <form action="index.php" method="POST">
                <input type="text" placeholder="email" name="email">
                <input type="text" placeholder="pseudonyme" name="pseudo">
                <input type="password" placeholder="mot de passe" name="password">
                <input type="text" placeholder="date de naissance, ex : 02/12/1800" name="birthdate">
                <input type="submit">
            </form>
            <?php
        }
        ?>
    </body>
</html>