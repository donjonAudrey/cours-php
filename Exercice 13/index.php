<?php

$validateFirstname = "false";
$validateLastname = "false";
$validateAge = "false";


if(!isset($_POST['firstname']) || strlen( $_POST['firstname']) < 1 || strlen( $_POST['firstname']) > 50){

    ?><p class="error">Attention votre Prénom doit contenir entre 1 et 50 caractères</p><?php

}else{
    $validateFirstname = true;
}

if(!isset($_POST['lastname']) ||  strlen( $_POST['lastname']) < 1 || strlen( $_POST['lastname']) > 50 ){

    ?><p class="error">Attention votre Nom doit contenir entre 1 et 50 caractères</p><?php
}else{
    $validateLastname = true;
}

if(!isset($_POST['age']) || $_POST['age'] < 1 || $_POST['age'] > 150){
    ?><p class="error">Attention votre âge doit être un chiffre entre 1 et 50</p><?php
}else{
    $validateAge = true;
}
if ($validateFirstname === true && $validateLastname === true && $validateAge === true ){
    ?><p>Bravo tu as <?php echo htmlspecialchars($_POST['age']) ?> ans</p><?php
}else{

}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Exercice 13</title>
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
        </style>
    </head>
    <body>
        <form action="index.php" method="POST">
            <div>
                <label for="firstname">Prénom : </label>
                <input name="firstname" id="firstname" type="text" placeholder="Prénom">
            </div>
            <div>
                <label for="lastname">Nom : </label>
                <input name="lastname" id="lastname" type="text" placeholder="Nom">
            </div>
            <div>
                <label for="age">Âge :</label>
                <input name="age" id="age" type="number" placeholder="Âge">
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </body>
</html>