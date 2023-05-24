<?php 

Class StatsGenreController
{
    function displayStatsGenres()
    {

        $modelData = new StatsGenresModel();            //getting data from model Object
        $rawFilmsByGenre = $modelData->getStatsGenres();


        $filmsByGenre = [];
        require_once("views/templates/statsGenre.php");

    }
    
}
