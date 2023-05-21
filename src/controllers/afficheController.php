<?php
require_once ("src/models/afficheModel.php");

function displayAffiche($id)
{
    $pathFile = getPathfile($id);
    require_once("views/templates/affiche.php");
    var_dump($pathFile[0]["image_film"]);    
}