<?php

    //1ère étape : Appel des variables (1 champ de formulaire = 1 isset) : consiste à vérifier si TOUTES les variables du formulaire existe
if(
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['age'])
){

    //2ème étape : bloc des vérifs (1 champ = 1 structure conditionnelle) : consiste pour chaque champ à vérifier qu'il contient bien des données valides

    //Vérification du champ Prénom
    if (mb_strlen($_POST['firstname']) < 2 || mb_strlen($_POST['firstname']) > 50) {
        $errors[] = "Le prénom doit contenir entre 2 et 50 caractères";
    }
    //Vérification du champ Nom
    if (mb_strlen($_POST['lastname']) < 2 || mb_strlen($_POST['lastname']) > 50) {
        $errors[] = "Le nom doit contenir entre 2 et 50 caractères";
    }
    //Vérification du champ Âge
    if (!is_numeric($_POST['age']) || $_POST['age'] < 1 || $_POST['age'] > 150 || !ctype_digit($_POST['age'])) {
        $errors[] = "Votre âge doit être un chiffre entre 1 et 150";
    }

    //3ème étape : si le formulaire n'a pas d'erreur, on fait les actions post-formulaire
    if (!isset($errors)) {
        // Création du message de succès en mettant la version protégée des données (sinon faille XSS)
        $successMsg = 'Bonjour ' . htmlspecialchars($_POST['firstname']) . ' ' . htmlspecialchars($_POST['lastname']) . ' tu as ' . htmlspecialchars($_POST['age']) . ' ans !';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../style.css">
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
            .valid{
                color: #7ec699;
            }
        </style>
    </head>
    <body>

    <?php
    // Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
    if(isset($errors)){
        foreach ($errors as $error){
            echo '<p class="error">' . $error . '</p>';
        }
    }
    // Si la variable $successMsg existe, alors on l'affiche, sinon on affiche le formulaire dans le else
    if (isset($successMsg)){
        echo '<p class="valid">' . $successMsg . '</p>';
    }else{
        ?>
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
        <?php
    }

    ?>

    </body>
</html>