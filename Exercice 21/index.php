<?php


    //1ere étape : Appel des variables
    if (isset($_POST['nameFruit']) &&
    isset($_POST['colorFruit']) &&
    isset($_POST['originFruit']) &&
    isset($_POST['priceFruit'])
    ){
        //2ème étape : bloc des vérifs

        //Vérification du nom du fruit
        if (!preg_match('/^.{2,25}$/i', $_POST['nameFruit'])){
            $errors[] = "Ton fruit doit contenir un nom entre 2 et 25 caractères";
        }

        //Vérification de la couleur du fruit
        if (!preg_match('/^.{2,25}$/i', $_POST['colorFruit'])){
            $errors[] = "Ton fruit doit contenir une couleur entre 2 et 25 caractères";
        }

        //Vérification de l'origine du fruit
        if (!preg_match('/^.{2,55}$/i', $_POST['originFruit'])){
            $errors[] = "le nom de l'origine de ton fruit doit être compris entre 2 et 25 caractères";
        }

        //Vérification du prix du fruit
        if (!preg_match('/^[0-9]{1,4}([.,][0-9]{1,2})?$/', $_POST['priceFruit'])){
            $errors[] = "Ton prix doit contenir un nombre maximum de 4 chiffres avant la virgule et maximum 2 chiffres après la virgule";
        }

        //3ème étape : Si le formulaire n'a pas d'érreur, on fait les actions post-formulaire
        if (!isset($errors)){

            //Connexion à la bdd
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root','');
                $bdd->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (Exception $e){
                die('Problème avec la bdd :' . $e->getMessage());
            }

            $response = $bdd->prepare("INSERT INTO fruits(`name`, color, origin, price) VALUES (?, ?, ?, ?)");

            $response->execute([
                $_POST['nameFruit'],
                $_POST['colorFruit'],
                $_POST['originFruit'],
                str_replace(',','.',$_POST['priceFruit']), //stockage en bdd du prix avec un point au lieu d'une virgule s'il y en a une
            ]);
            // Si rowCount renvoi plus de 0, alors l'insertion a fonctionné, sinon erreur
            if ($response->rowCount()> 0){
                $successMsg ="Votre fruit a bien été créé !";
            }else{
                $errors[] = 'Problème interne au site veuillez ré-essayer plus tard';
            }

            //Fermeture requête
            $response->closeCursor();
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
        <style>
            p{
                font-size: 2rem;
                font-family: "Roboto, Arial";
                text-align: center;
            }
            .error{
                color: darkred;
                font-weight: bold;
            }
            .valid{
                color: #7ec699;
            }
        </style>
    </head>
    <body>
    <h1>Ajouter un nouveau fruit</h1>
    <?php
        //Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les errreurs qu'il contient
        if (isset($errors)){
            foreach ($errors as $error){
                echo '<p class="error">' . $error . '</p>';
            }
        }
        //Si la variable $successMsg existe, alors on l'affiche, sinon on affiche le formulaire dans le else

        if (isset($successMsg)){
            echo '<p class="valid">' . $successMsg . '</p>';
        }else{
    ?>
        <form action="index.php" method="POST">
            <div>
                <label for="nameFruit">Nom de nouveau fruit :</label>
                <input type="text" name="nameFruit" placeholder="Nom de fruit">
            </div>

            <div>
                <label for="colorFruit">Couleur du nouveau fruit</label>
                <input type="text" name="colorFruit" placeholder="Couleur du fruit">
            </div>

            <div>
                <label for="originFruit">Origine du nouveau fruit</label>
                <input type="text" name="originFruit" placeholder="Origine du fruit">
            </div>

            <div>
                <label for="priceFruit">Prix du nouveau fruit</label>
                <input type="number" name="priceFruit" placeholder="Prix au kg">
            </div>

            <input type="submit" value="Ajouter">
        </form>
            <?php
        }
    ?>
    </body>
</html>