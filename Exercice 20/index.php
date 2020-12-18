<?php
//Tentative de connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    //Si la connexion à échouée, le die() stop la page et affiche un message
    die('Problème avec la base de données : ' . $e->getMessage());
}

$response = $bdd->query('SELECT * FROM fruits');
$fruit = $response->fetch(PDO::FETCH_ASSOC);
$response->closeCursor();

echo '<pre>';
print_r($fruit);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exerice 20 : BDD 01</title>
    </head>
    <body>

        <ul>
            <?php
            //On parcours les fruits pour les afficher un par un dans un li
            foreach ($fruit as $fruits){
                ?>

                <li><?php echo $fruits['name'];?></li>

                <?php
            }

            ?>
        </ul>


    </body>
</html>