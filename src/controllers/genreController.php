<?php 
require_once ('src/models/genreModel.php');

function displayGenres()
{
    $genres = getGenres();
    require "views/templates/genreListing.php";
}

function updateGenre($dataGenres, $id)
{
    foreach ($dataGenres as $fieldName=>$value)
    {
        $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);    //Sanitizing value in array
        $dataGenre[$fieldName] = $filteredValue;                                     //replacing original values by sanitized
    }
    var_dump($filteredValue);
    var_dump($id);
    updateGenreModel($filteredValue,$id);
}

function addGenre($genreData)
{
    $filteredGenreData = filter_var($genreData,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    addGenreModel($filteredGenreData);
}
function deleteGenre($id)
{
    deleteGenreModel($id);
}