<?php
require_once ("src/models/afficheModel.php");
require_once ("src/models/filmModel.php");

function displayAffiche($id) 
{
    $filmData = getOneFilmData($id);
    $pathFile = getPathfile($id); //Getting the filepath from DB
    $synopsis = getSynopsis($id);
    if (in_array(!empty($pathFile[0]["image_film"]),$pathFile)) $thereIsAFile = true; else $thereIsAFile = false;
    require_once("views/templates/affiche.php");
}