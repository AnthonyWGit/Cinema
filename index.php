<?php
// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
require_once("src/controllers/filmController.php");
if (isset($_GET["action"]) &&  $_GET["action"] == "updateFilms")
{   
    $dataFilm = $_POST;
    $idZ = $_GET["id_film"];
    var_dump($_POST);
    updateFilms($dataFilm, $idZ);
}
else if (isset($_GET["action"]) && $_GET["action"] == "displayFilms")
{
    displayFilms();
}
else if (isset($_GET["action"]) && $_GET["action"] == "uploadFile")
{
    $id = $_GET["id_film"];
    $file = $_FILES;
    var_dump($_FILES);
    uploadFile($file,$id);
}
else //page when landing on site 
{
    displayFilms();
}

