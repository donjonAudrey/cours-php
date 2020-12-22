<?php
//appel de variable
if (isset($_GET['search'])
){
    //Bloc des vérifs
    if (mb_strlen($_GET['search']) < 1 || mb_strlen($_GET['search']) > 50){
        $error = '<p style="red">ta recherche doit contenir entre 1 et 50 caractères</p>';
    }

    //si pas d'erreurs
    if (!isset($error)){
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
            $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die('Problème avec la bdd : ' . $e->getMessage());
        }
        // Requête préparée pour chercher le fruit (requête préparée car il y a des variables PHP à mettre dedans, donc on se protège des injections SQL)
        $searchFruits = $bdd->prepare("SELECT * FROM `fruits` WHERE name LIKE ? ");

        // Execution de la requête en liant le marqueur à sa variables PHP
        $searchFruits->execute([
            '%'.$_GET['search'].'%'
        ]);
        $fruits = $searchFruits->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($fruits);

        if (empty($fruits)){
           $error  = 'Ce fruit n\'existe pas';
        }
        // Fermeture de la requête
        $searchFruits->closeCursor();
    }

}


?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 23 : Recherche</title>
        <style>
            table, table tr th, table tr td{
                border: solid 2px rebeccapurple;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <form action="index.php" method="GET">
            <label for="search">Recherche de fruits :</label>
            <input type="text" name="search">
            <input type="submit" value="Rechercher">
        </form>
        <?php
        //Si l'array $errors existe, alors on affiche l' erreur
        if (isset($error)){
                echo '<p>' . $error . '</p>';
        }
        //Si la variable $succssMsg existe, alors on l'affiche, sinon on affiche le formulaire dans le else
        if (!empty($fruits)){
            echo '<p>Il y a ' . count($fruits) . ' résultat(s) pour la recherche"' . htmlspecialchars($_GET['search']) . '"</p>';
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Couleur</th>
                            <th>Pays d'origine</th>
                            <th>Le prix</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($fruits as $fruit){
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($fruit['name']) . '</td>';
                            echo '<td>' . htmlspecialchars($fruit['color']) . '</td>';
                            echo '<td>' . htmlspecialchars($fruit['origin']) . '</td>';
                            echo '<td>' . htmlspecialchars($fruit['price']) . '€ </td>';
                            echo '</tr>' ;
                        }
                    ?>
                    </tbody>
                </table>


            <?php
        }else{

        }

        ?>

    </body>
</html>