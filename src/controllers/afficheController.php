<?php
require_once ("src/models/afficheModel.php");

function displayAffiche($id) 
{
    $pathFile = getPathfile($id); //Getting the filepath from DB
    $synopsis = getSynopsis($id);
    if (in_array(!empty($pathFile[0]["image_film"]),$pathFile)) $thereIsAFile = true; else $thereIsAFile = false;
    require_once("views/templates/affiche.php");
}