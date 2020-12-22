
<?php

//Appel des variables

if (
    isset($_POST['email']) &&
    isset($_FILES['image'])
){
    //Bloc des verifs

    //Vérification du mail
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email invalide";
    }
    //Vérifications du fichier
    $typeFile = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['image']['tmp_name']);

    if (!$_FILES['image']['error'] == 0) {
        $errorsFile = [
            1 => "erreur 01 : taille du fichier plus grande que celle prévue",
            2 => "erreur 02 : taille du fichier plus grande que celle prévue",
            3 => "erreur 03 : fichier partiellement téléchargé par le serveur",
            4 => "erreur 04 : aucun fichier envoyé",
            6 => "erreur 06 : dossier temporaire manquant",
            7 => "erreur 07 : echec d'écriture",
            8 => "erreur 08 : problème avec un module PHP"
        ];
    }elseif($typeFile != "image/jpeg" || $typeFile != "image/png" || $typeFile != "image/gif" ){
        $errors[] = "Format de fichier invalide";
    }



    //Si le formulaire n'a pas d'erreur, on fait les actions post-formulaire
    if (!isset($errors) && !isset($errorsFile)) {
        // Création du message de succès en mettant la version protégée des données (sinon faille XSS)
        $success = 'Votre image a bien été envoyé';
        move_uploaded_file($_FILES['image']['tmp_name'],'image/'.md5($_FILES['image']['name']).$_FILES['name']['type']);
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 25</title>
    </head>
    <body>
        <?php
            //Si $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
            if (isset($errors)){
                foreach ($errors as $error){
                    echo '<p style="color: darkred;">' . $error . '</p>';
                }
            }
            if (isset($errorsFile)){
                echo '<p style="color: darkred;">' . htmlspecialchars($errorsFile[$_FILES['image']['error']]). '</p>';
            }
            //Si la variable $succss existe
            if (isset($success)){
                echo '<p style="color: darkgreen">' . $success . '</p>';
            }
        ?>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Email" name="email">
            <input type="hidden" name="MAX_FILE_SIZE" value="20148000">
            <input type="file" name="image" accept="image/jpeg, image/png, image/gif">
            <input type="submit">
        </form>
    </body>
</html>