
<?php

// Création d'un array contenant des utilisateurs avec leurs infos (les activitées sont elle même dans un sous-tableau)
$usersInfos = [
    [
        'name' => 'Groot',
        'Activities'  => ['Absorbe le bois', 'contrôle les arbres', 'résistance au feu'],
        'city' => 'la planète X',
    ],
    [
        'name' => 'Rocket',
        'Activities'  => ['pilote accompli', 'excellent tireur'],
        'city' => 'la planète Halfworld',
    ],
    [
        'name' => 'Star-Lord',
        'Activities'  => ['Aventurier', 'élève astronaute de la NASA', 'leader des Gardiens de la Galaxie'],
        'city' => 'Colorado',
    ],
    [
        'name' => 'Gamora',
        'Activities'  => [' Assassin' , 'mercenaire'],
        'city' => 'la planète Zen-Whoberi',
    ],
    [
        'name' => 'Drax',
        'Activities'  => [],//aucune activitées donc array vide
        'city' => 'Californie',
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 8</title>
        <style>
            .textRedInfosUser{
                color:red;
                font-weight: bold;
            }
            .textInfosUser{
                color:#6196cc;
                font-weight: bold;
            }
            .style_section{
                padding: 1rem;
            }
        </style>
    </head>
    <body>
        <section class="style_section">
            <?php
            //On parcours tous les utilisateurs avec un foreach pour afficher une structure HTML pour chacun d'entre eux
            foreach($usersInfos as $userInfos){
                ?>
                <!--Titre h2 avec le prénom de l'utilisateur actuellement extrait par le foreach dans $userInfos-->
                <h2><?php echo $userInfos['name'] ?></h2>
                <!--Idem aves les infos dans une phrase-->
                <p> Bonjour <span class="textInfosUser"><?php echo $userInfos['name']?></span>,
                    tu es originaire de <span class="textInfosUser"><?php echo $userInfos['city'];?></span>.
                </p>

                <!--Si l'utilisateur a au moins 1 activitée (il faut que le tableau des activitées soit d'une taille minimum à 1), alors on affichera ces activités, sinon on ira dans le else pour afficher un message d'erreur-->
                <?php
                if (count($userInfos['Activities']) > 0) {
                    // Ouverture de la liste à puce
                    ?>
                    <ul>
                        <?php
                        //On parcours les activitées pour les afficher un par un dans un li
                        foreach ($userInfos['Activities'] as $activities){
                        ?>

                        <li><span class="textInfosUser"><?php echo $activities;?></span></li>

                        <?php
                        }
                        ?>
                        <!--Fermeture de la balise ul-->
                    </ul>
                    <?php
                }else{
                    ?>

                    <li class="textRedInfosUser">Cette utilisateur ne pratique aucune activitées particulière.</li>

                    <?php
                }
                echo '<hr>';
            }
            ?>
        </section>
    </body>
</html>