<?php


// Récupération du nb actuel de visite
$visits = file_get_contents('compteur.txt');

// Augmentation du nb de visite de 1
$visits++;
move_uploaded_file($_FILES['photo']['tmp_name'],'images/exemple.jpg');
//Sauvegarde du nouveau nb dans le fichier compteur.txt
file_put_contents('compteur.txt', $visits)


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
        <h1>Cette page a été vu <?php echo $visits; ?> fois</h1>
    </body>
</html>