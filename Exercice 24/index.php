<?php
//Connexion au fichier
$myFile = fopen('compteur.txt', 'r+');

// Récupération du nb actuel de visite
$compteur = fread($myFile,25);

// Augmentation du nb de visite de 1
$compteur++;

//Replacement du curseur PHP au début du fichier (pour écrire par dessus l'ancien)
fseek($myFile, 0);

//Ecriture du nouveau nb dans le fichier à la place de l'ancien
fwrite($myFile, $compteur);

//Fermeture de la connexion
fclose($myFile);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 24</title>
    </head>
    <body>
        <h1>Cette page a été vu <?php echo $compteur ?> fois</h1>
    </body>
</html>