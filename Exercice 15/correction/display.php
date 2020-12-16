<?php
//Obligatoire pour avoir accès aux sessions
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 15</title>
    </head>
    <body>
        <h1>Profil</h1>
        <?php include 'menu.php';

        //Si l'array user existe en session (ce qui revient à dire que l'utilisateur est connecté, on affiche une phrase de bienvenue à l'utilisateur, sinon un message invitant à se connecter

        if (isset($_SESSION['user'])){
            echo 'Bienvenue sur votre compte ' . htmlspecialchars($_SESSION['user']['firstname']) . ' ' . htmlspecialchars($_SESSION['user']['lastname']) . '!';
        }else{
            echo 'Merci de vous connecter d\'abords <a href="create.php">Ici</a>';
        }

        //Version avant l'utilisation d'un array
//       if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
//            echo 'Bonjour ' . htmlspecialchars($_SESSION['firstname']) . ' ' . htmlspecialchars($_SESSION['lastname']) . '!';
//        }else{
//            echo 'Merci de vous rendre d\'abord sur la page create <a href="create.php">Ici</a>';
//        }

        ?>
    </body>
</html>


