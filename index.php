<?php
// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
require_once("src/controllers/filmController.php");
require_once("src/controllers/synopsisController.php");
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

else if (isset($_GET["action"]) && $_GET["action"] == "goToSynopsis")
{
    $id = $_GET["id"];
    displaySynopsis($id);
}

else if (isset($_GET["action"]) && $_GET["action"] == "editSynopsis")
{
    $id = $_GET["id"];
    $textSynopsis = $_POST["textSynopsis"];
    editSynopsis($textSynopsis, $id);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addFilm")
{

    $filmData = $_POST;
    $fileData = $_FILES;
    addFilm($filmData,$fileData);
}
else //page when landing on site 
{
    displayFilms();
}

