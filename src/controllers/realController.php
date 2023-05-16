<?php 
require_once "src/models/realisateurModel.php";

function displayReals()
{
    $realisateurs = getRealisateurs();
    require_once "views/templates/realsListing.php";
}