<?php

    //1ère étape : Appel des variables (1 champ de formulaire = 1 isset) : consiste à vérifier si TOUTES les variables du formulaire existe
if(
    isset($_POST['color'])
){

    //2ème étape : bloc des vérifs (1 champ = 1 structure conditionnelle) : consiste pour chaque champ à vérifier qu'il contient bien des données valides

    //Vérification du champ color
    if (mb_strlen($_POST['color']) < 2 || mb_strlen($_POST['color']) > 10) {
        $errors[] = "La couleur doit contenir entre 2 et 10 caractères";
    }

    //3ème étape : si le formulaire n'a pas d'erreur, on fait les actions post-formulaire
    if (!isset($errors)) {
        // Création de la récupération du code couleur et du cookie en mettant la version protégée des données (sinon faille XSS)
        $successColor = ($_POST['color']);
        $colorCookie = setcookie('colorCookie', $successColor, time()+ (24*3600), null, null, false, true);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 14</title>
        <style>
            p,a{
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

    <?php
    // Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
    if(isset($errors)){
        foreach ($errors as $error){
            echo '<p class="error">' . $error . '</p>';
        }
    }
    // Si la variable $successColor existe, alors on l'affiche, sinon on affiche le formulaire dans le else
    if (isset($successColor)){
        ?>
    <body style="background-color: <?php echo htmlspecialchars($_POST['color']); ?> ;">
        <a href="index.php">Retour</a>
        <?php
    }else{?>
        <body style="background-color: <?php echo htmlspecialchars($_COOKIE['colorCookie']); ?> ;">

            <form action="index.php" method="POST">
                <div>
                    <input name="color" id="color" type="color">
                </div>
                <input type="submit">
            </form>
        <?php
    }

    ?>

    </body>
</html>