<?php 
require_once ("src/models/filmModel.php");

function displaySynopsis($id)
{
    $synopsisIsEmpty = true;
    $film = getFilms(); // we don't actually display all the films but we need it to get $films["synopsis"];
    (empty($film[$id]["synopsis"])) ? $synopsisIsEmpty = true : $synopsisIsEmpty = false;
    require("views/templates/editSynopsis.php");
}

function editSynopsis($textSynopsis, $id)
{

    updateFilmSynopsis($textSynopsis, $id);
    header("Location:index.php?action=displayFilms");
}

