<?php 
require_once ("src/models/filmModel.php");
require_once ("src/models/statsFilmsModel.php");

function displayStatsFilms()
{
    $filmsFiveYears = getStatsCinqFiveYears();
    $filmsLenght = getStatsDeuxHeures();
    require ("views/templates/statsFilms.php");
}
