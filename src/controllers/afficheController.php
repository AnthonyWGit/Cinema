<?php
require_once ("src/models/afficheModel.php");

function displayAffiche($id) 
{
    $pathFile = getPathfile($id); //Getting the filepath from DB
    $synopsis = getSynopsis($id);
    require_once("views/templates/affiche.php");
}