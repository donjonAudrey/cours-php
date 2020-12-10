<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <ul>
        <?php
            $i = 0;
            while($i<5000){

                echo '<li>'.++$i.'</li>';

                //2em methode
                //echo '<li>'.($i+1).'</li>';
                //i++

                //3em methode
                //i++
                //echo '<li>'.$i.'</li>';

            }
        ?>
    </ul>
    </body>
</html>