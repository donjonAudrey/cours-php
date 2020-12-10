
<?php
$firstnames = ['Alice','Bob','Bébé Groot','Poppy','Lisa','Jean','George','Julien','Sarah','Sacha'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 6</title>
    </head>
    <body>
        <ul>
            <?php
            //On récupère le taille de l'array avec count()
            //$arrayLength = count($firstnames);

            //On boucle autant de fois qu'il y a d'éléments dans l'array $names (avec count pour compter l'array)
                for($i = 0; $i < 10; $i++){ //for($i = 0; $i < count($firstnames); $i++) // count correspond à la longueur du tableau

                    echo '<li>'.$firstnames[$i].'</li>';

                }
            ?>
        </ul>
    </body>
</html>