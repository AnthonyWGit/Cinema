<?php 
require_once ("src/models/genreModel.php");
require_once ("src/models/statsGenresModel.php");

function displayStatsGenres()
{
    $filmsByGenre = [];
    $rawFilmsByGenre = getStatsGenres();
    require_once("views/templates/statsGenre.php");
}

