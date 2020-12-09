
<?php

$admin  = true;

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 03</title>
        <style>
            .notAdmin{
                color:red;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <?php
            if($admin === false){
                echo '<p>Bienvenu Mr l\'admin Je te prierais de bien vouloir aller sur ce lien : </p><a href="#">Le lien ici</a>';
            }else{
                echo '<p class="notAdmin">Vous ne faites pas partie des admins de ce site, accès non autorisé !</p>';
            }
        ?>
    </body>
</html>