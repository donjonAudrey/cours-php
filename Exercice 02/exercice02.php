<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 02</title>
        <?php
        $colorPage = '#000000';
        $firstName = 'Alice';
        ?>
    </head>
    <body style="background-color:<?php echo $colorPage ;?>;">
        <h1 style="color:white";><?php echo 'Bonjour '.$firstName; ?></h1>
    </body>
</html>