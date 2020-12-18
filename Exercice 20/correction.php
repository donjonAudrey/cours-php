<?php
//Connexion à la bdd
try {
    $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root','');
    $bdd->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch (Exception $e){
    die('Problème avec la bdd :' . $e->getMessage());
}
//Si $_GET ['color'] existe dans l'url, alors on cherchera tous les fruits de cette couleur, sinon on récupèrera tous les fruits (dans le else)
if (isset($_GET['color'])) {

//Requête pour récupérer tous les fruits dont la couleur est celle présente dans l'url (requête préparée car on a une variable PHP dans la requète)
    $response = $bdd->prepare("SELECT * FROM fruits WHERE color = ?");
    $response->execute([
        $_GET['color']
    ]);
}else{
    //Requête pour récupérer tous les fruits (requête directe (query) car on a pas de variable PHP dans la requête)
    $response = $bdd->query('SELECT * FROM fruits');
}


//Récupération des fruits sous forme d'arrays associatifs
$fruits = $response->fetchAll(PDO::FETCH_ASSOC);

//Fermeture requête
$response->closeCursor();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Correction Exercice 20</title>
    </head>
    <body>
    <form action="correction.php" method="GET">
        <input type="text" name="color">
        <input type="submit">
    </form>
    <!--Si il y a des fruits à afficher, on les affiche dans une liste ul oli, sinon message d'erreur-->
        <?php
        if (!empty($fruits)){
        echo '<ul>';
        //chaque fruit sera dans un li
        foreach ($fruits as $fruit){

            echo '<li>' . htmlspecialchars($fruit['name']) . ' ' . htmlspecialchars($fruit['color']) . '</li>';

        }
        echo '<ul>';
        }else{
            echo '<p>Aucun fruits à afficher !</p>';
        }
        ?>
    </body>
</html>
