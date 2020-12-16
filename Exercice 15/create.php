<?php
    session_start();

    if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        echo "Mes variables de session existent";
    }else{
        echo "Mes variables de session n'existent pas";
        $_SESSION['firstname'] = 'Alice';
        $_SESSION['lastname'] = 'Gillya';
    }


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
        <h1>Page de création</h1>
        <?php include 'menu.php';?>
        <p>Bonjour <?php echo  $firstname . " " . $lastname?>
    </body>
</html>


