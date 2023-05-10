<?php
// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
require_once("src/controllers/filmController.php");
if (isset($_GET["action"]) &&  $_GET["action"] == "updateFilms")
{
    var_dump($_GET);
    var_dump($_POST);
}
else
{
    displayFilms();
}

