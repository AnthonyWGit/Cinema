<?php
// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
require_once("src/controllers/filmController.php");
if (isset($_GET["action"]) &&  $_GET["action"] == "updateFilms")
{   
    $dataFilm = $_POST;
    $idZ = $_GET["id_film"];
    var_dump($_POST);
    var_dump($idZ);
    updateFilms($dataFilm, $idZ);
}
else
{
    displayFilms();
}

