<?php
//Obligatoire pour avoir accès aux sessions
session_start();
// version d'avant la construction d'un array avec un destroy
// session_destroy();

//Supprime l'array user dans la session, sans supprimer toute la session comme le ferais un session_destroy().
unset($_SESSION['user'])
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
        <h1>Deconnexion</h1>
        <?php include 'menu.php';?>
        <p>Vous avez bien été déconnecté !</p>
    </body>
</html>


