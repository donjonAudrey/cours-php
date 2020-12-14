<?php

//Exercice 10-a : Afficher la date avec la fonction date sous la forme suivante : "friday 11 december 2020, 14h 55m 30s"

echo date('l d F Y, H\h i\m s\s');
echo '<br>';
echo '<br>';
//Exercice 10-b : Chercher à afficher la date avec strftime en français en vous aidant de google et de php.net

setlocale(LC_ALL,'fra','fr_FR');
echo utf8_encode(strftime('%A %d %B %Y, %Hh %Mm %Ss'));
echo '<br>';
echo '<br>';

//Exercice 10-c : Avec la fonction date(), afficher à l'écran la date qu'il fera dans 26 jours sous le format suivant : 2020-12-11 06:42:30


$time26DaysAfter = time() + (26*24*3600 + 16*3600);
echo 'Aujourd\'hui : '. date('Y-m-d') ."\n";
echo '<br>';
echo 'Dans 26 jour et 16h :  '.date('Y-m-d H:i:s',$time26DaysAfter)."\n";



//Exercice 10-d : Créer une variable contenant cette date précise textuelle : "2004-04-16 12:00:00" le but est d'ajouter 435 jours à cette date puis de l'afficher sous le format suivant : "samedi 25 juin 2005, 06h 00m 00s"
echo '<br>';
echo '<br>';
//Mettre en français(en commentaire, car déjà mis plus haut dans le fichier
//setlocale(LC_ALL,'fra','fr_FR');

// Date de départ sous forme de textuelle
$dateToTransform = '2004-04-16 12:00:00';

//Convertion de la date initiale en timestamp (pour pouvoir faire des calculs dessus)
$dateToTransformTimestemp = strtotime($dateToTransform);
//$timestempDateAdd= strtotime('435 days');

//Création d'un nouveau timestamp qui correspond au timestamp initial + 435 jours
$newDateTimestamp = $dateToTransformTimestemp + 435*24*60*60;

//Affichage de la nouvelle date en utilisant son timestamp
echo strftime('%A %d %B %Y, %Hh %Mm %Ss',$newDateTimestamp);