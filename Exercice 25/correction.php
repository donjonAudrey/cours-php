<?php
//Appel des variables

if (
    isset($_POST['email']) &&
    isset($_FILES['photo'])
) {
    $fileErrorCode = $_FILES['photo']['error'];
    //Bloc des verifs

    //Vérification du mail
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email invalide";
    }

    //Vérification du fichier (type d'erreur et grandeur de l'image)
    if ($fileErrorCode == 1 || $fileErrorCode == 2 || $fileErrorCode['photo']['size'] > 5000000){
        $errors[] = 'Fichier trop grand !';
    }elseif ($fileErrorCode == 3){
        $errors[] = 'Fichier non reçu en totalité, veuillez ré-essayer';
    }elseif ($fileErrorCode == 4){
        $errors[] = 'Veuillez choisir une image !';
    }elseif ($fileErrorCode == 6 || $fileErrorCode == 7 || $fileErrorCode == 8){
        $errors[] = 'Problème serveur, veuillez ré-essayer plus tard';
    }elseif ($fileErrorCode != 0){
        $errors[] = 'Problème, veuillez ré-essayer';
    }
    //Autres Vérifications(Type MIME et nom d'image d'éjà existant) si il n'y a pas d'erreurs durant l'envoie et la grandeur de l'image
    if (!isset($errors)){

        $allowedMIMIType = [
          'image/jpeg',
          'image/png',
          'image/gif',
        ];

        $photoMIMEType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['photo']['tmp_name']);

        if(!in_array($photoMIMEType, $allowedMIMIType)){ //vérification du type MIME
            $errors[] = 'L\'image doit être un jpg, png ou un gif !';
        }
        //Si il n'y a pas d'erreur pour le type MIME
        if(!isset($errors)){
            //Permet de définir le nom de l'extension
            if ($photoMIMEType == 'image/jpeg'){
                $newPhotoExt = 'jpg';
            }elseif ($photoMIMEType == 'image/png'){
                $newPhotoExt = 'png';
            }elseif ($photoMIMEType == 'image/gif'){
                $newPhotoExt = 'gif';
            }
            //Permet de générer un autre nom de fichier si il en existe déjà un simmilaire
            do {
                //Nom de fichier renommé avec le md5 du timestamp d'aujourd'hui ainsi qu'un nombre aléatoire concaténé à l'extension de l'image
                $newPhotoName = md5( time() . rand() ) . '.' . $newPhotoExt;
            }while (file_exists('images/' . $newPhotoName));

            //Image renommé et mise dans le dosssier image
            move_uploaded_file($_FILES['photo']['tmp_name'],'image/'.$newPhotoName);
            $success = 'Votre image est bien envoyé';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <!--Formulaire d'envoie d'image + champ mail-->
        <form action="correction.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
            <input type="text" name="email" placeholder="Email">
            <input type="file" name="photo" accept="image/jpeg, image/png, image/gif">
            <input type="submit">
        </form>

        <?php
        //Si la variable $success $errors
        if (isset($errors)){
            foreach ($errors as $error){
                echo '<p style="color: darkred;">' . $error . '</p>';
            }
        }
        //Si la variable $success existe
        if (isset($success)){
            //Affichage du message de succès après envoie de l'image
            echo '<p style="color: darkgreen">' . $success . '</p>';
            //Affichage de l'image envoyé
            echo '<img src="image/'. $newPhotoName . '"/>';
        }
        ?>
    </body>
</html>