<?php 
require_once ("src/models/genreModel.php");
require_once ("src/models/statsGenresModel.php");

function displayStatsReals()
{
    $films = getStatsGenres();
    require_once("views/templates/statsReals.php");
}

