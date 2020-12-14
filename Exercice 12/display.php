

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 12</title>
    </head>
    <body>
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
        div{
            width: 400px;
            margin: auto;
        }
        img{
            width: 100%;
        }
    </style>

<!--EXO par moi-->
<!--        --><?php
//        if(!empty($_GET['firstname']) && !empty($_GET['email'])){
//            ?>
<!--            <p>Bonjour <span class="valid">--><?php //echo $_GET['firstname'] ?><!--</span> ton adresse mail est <span class="valid">--><?php //echo $_GET['email']?><!--</span></p><div><img src="images/valid.jpg" alt=""></div>-->
<!--            --><?php
//        }else{
//            ?><!--<p class="error">Vous devez compléter les champs du formulaire et le valider pour avoir accès à cette page !</p>-->
<!--            <a href="form.php">Retour</a><br><div><img src="images/error.jpg" alt=""></div>--><?php
//        }
//        ?>
<!--CORRECTION-->
    <?php
    if(isset($_GET['firstname']) && isset($_GET['email'])){
        ?>
        <p>Bonjour <span class="valid"><?php echo htmlspecialchars($_GET['firstname']) ?></span> ton adresse mail est <span class="valid"><?php echo htmlspecialchars($_GET['email'])?></span></p><a href="form.php">Retour</a><br><div><img src="images/valid.jpg" alt=""></div>
        <?php
    }else{
        ?><p class="error">Vous devez compléter les champs du formulaire et le valider pour avoir accès à cette page !</p>
        <a href="form.php">Retour</a><br><div><img src="images/error.jpg" alt=""></div><?php
    }
    ?>
    </body>
</html>