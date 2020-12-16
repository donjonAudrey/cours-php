<?php

//Obligatoire pour avoir accès aux sessions
session_start();

// Version d'avant la construction avec un array
//if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
//    $error = "les variables ont déjà été créées !";
//}else{
//    $_SESSION['firstname'] = 'Alice';
//    $_SESSION['lastname'] = 'Durand';
//
//    $success = "Les variables existent !";
//}



//Si l'array "user" existe en session on crée  un message d'erreur, sinon on le créé avec ses données et message de succès
if (isset($_SESSION['user'])){
    $error = "Vous êtes déjà connecté!";
}else{
    //L'array user contiendra toutes les données de l'utilisateur connecté
    $_SESSION['user'] = [
            'firstname' => 'Alice',
            'lastname' => 'Durand'
    ];
    $success = "Vous êtes bien connecté";
}

//Version d'avant utilisation d'un array qui est plus pratique
//$_SESSION['firstname'] = 'Alice';
//$_SESSION['lastname'] = 'Durand';
//
//$success = "Les variables existent !";


?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Connexion</title>
    </head>
    <body>
        <h1>Connexion</h1>
        <?php include 'menu.php';

        if (isset($success)){
            echo '<p style="color: #7ec699">' . $success . '</p>';
        }
        if (isset($error)){
            echo '<p style="color: darkred">' . $error . '</p>';
        }
        ?>

    </body>
</html>


