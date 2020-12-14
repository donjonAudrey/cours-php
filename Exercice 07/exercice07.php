
<?php
$userInfos = [
    'name' => 'Groot',
    'old'  => '211 ans',
    'city' => 'planète X',
    'pets' => 'raton laveur',
    'numberPets'=> 'un',
];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 7</title>
        <style>
            .textInfosUser{
                color:red;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <p> Bonjour je s'appelle <span class="textInfosUser"><?php echo $userInfos['name']?></span>,
            J'ai <span class="textInfosUser"><?php echo $userInfos['old'];?></span> ans,
            j'habites sur la <span class="textInfosUser"><?php echo $userInfos['city'];?></span> dont je suis le monarque,
            et j'ai <span class="textInfosUser"><?php echo $userInfos['numberPets'] . " " . $userInfos['pets'];?></span>.
        </p>
    </body>
</html>