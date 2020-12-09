
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
        <h1>Exercice 03</h1>
        <?php
        //Même si la balise PHP se ferme avant la fermeture du if, le code HTML déclaré entre sera considéré comme faisant partie de la condition.
        if($admin){

            ?>
            <p>Bienvenu Mr l'admin Je te prierais de bien vouloir aller sur ce lien : </p><a href="https://resize-elle.ladmedia.fr/rcrop/1024,1024/img/var/plain_site/storage/images/societe/news/phenomene-que-cache-notre-addiction-aux-images-de-chatons-3869316/93623270-2-fre-FR/Phenomene-que-cache-notre-addiction-aux-images-de-chatons.jpg">Le lien ici</a>
            <?php

        }else{

            ?>
            <p class="notAdmin">Vous ne faites pas partie des admins de ce site, accès non autorisé !</p>
            <?php
        }

        ?>
    </body>
</html>