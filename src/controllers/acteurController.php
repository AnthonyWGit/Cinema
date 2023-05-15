<?php 
require_once ("src/models/acteurModel.php");

function displayActeurs()
{
    $acteurs = getActeurs();
    require "views/templates/acteursListing.php";
}

function updateActeur($dataActeurs,$id)
{
    updateActeurModel($dataActeurs,$id);
}