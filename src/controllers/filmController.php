<?php 

require ("src/models/filmModel.php");
function displayFilms()
{
    $filmsList = getFilms(); 
    require("views/templates/filmListing.php");
}

function updateFilms($filmData)
{
    updateFilmsModel($filmData);
}
