
<?php
//1ère étape : Appel des variables
if (isset($_POST['email']) &&
    isset($_POST['age']) &&
    isset($_POST['favoriteWebsite'])
){
    //2ème étape : bloc des vérifs

    //Vérification du champ email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = "Ton email doit être valide";
    }

    //Vérification du champ age
    if (!filter_var($_POST['age'], FILTER_VALIDATE_INT) || $_POST['age'] > 150 || $_POST['age'] < 0 ){
        $errors[] = "Ton âge doit être un entier positif entre 0 et 150";
    }

    //Vérification du champ url
    if (!filter_var($_POST['favoriteWebsite'], FILTER_VALIDATE_URL)){
        $errors[] = "Ton url doit être valide";
    }

    //3ème étape : si le formulaire n'a pas d'erreur, on fait les actions post-formulaire
    if (!isset($errors)) {
        // Création du message de succès en mettant la version protégée des données (sinon faille XSS)
        $successMsg = 'Vos données ont bien été récoltées, merci pour ça!';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 16</title>
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
                    <label for="email">Votre adresse mail :</label>
                    <input type="text" name="email">
                </div>
                <div>
                    <label for="age">Votre âge :</label>
                    <input type="text" name="age">
                </div>
                <div>
                    <label for="favoriteWebsite">L'url de votre site préféré :</label>
                    <input type="text" name="favoriteWebsite">
                </div>
                <input type="submit">
            </form>
            <?php
        }
        ?>
    </body>
</html>