<?php
// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
require_once("src/controllers/acteurController.php");
require_once("src/controllers/filmController.php");
require_once("src/controllers/synopsisController.php");
require_once("src/controllers/realController.php");

//---------------------- ACTIONS UPDATE---------------------------------------

if (isset($_GET["action"]) &&  $_GET["action"] == "updateFilms")
{   
    $dataFilm = $_POST;
    $idZ = $_GET["id_film"];
    updateFilms($dataFilm, $idZ);
}
if (isset($_GET["action"]) &&  $_GET["action"] == "updateActeur")
{   
    $dataActeurs = $_POST;
    $id = $_GET["id_acteur"];
    updateActeur($dataActeurs, $id);
}
if (isset($_GET["action"]) &&  $_GET["action"] == "updateRealisateur")
{   
    $dataReals = $_POST;
    $id = $_GET["id_realisateur"];
    updateReal($dataReals, $id);
}

//--------------------END ACTIONS UPDATE ---------------------------------------

//----------------------ACTIONS DISPLAY -----------------------------------------

else if (isset($_GET["action"]) && $_GET["action"] == "displayFilms")
{
    displayFilms();
}
else if (isset($_GET["action"]) && $_GET["action"] == "displayActeurs")
{
    displayActeurs();
}
else if (isset($_GET["action"]) && $_GET["action"] == "displayReals")
{
    displayReals();
}

//------------------END ACTION DISPLAY-----------------------------------------------

//-------------------------ACTIONS ADD STUFF ----------------------------------

else if (isset($_GET["action"]) && $_GET["action"] == "addFilm")
{

    $filmData = $_POST;
    $fileDataa = $_FILES;
    addFilm($filmData,$fileDataa);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addActeur")
{

    $actorData = $_POST;
    addActeur($actorData);
}

//----------------------------------END ACTIONS ADD STUFF ----------------------------

//------------------------------ACTION DELETE STUFF-------------------------------------

else if (isset($_GET["action"]) && $_GET["action"] == "deleteFilm")
{
    $id = $_GET["id"];
    deleteFilm($id);
}

else if (isset($_GET["action"]) && $_GET["action"] == "deleteActeur")
{
    $id = $_GET["id_acteur"];
    deleteActeur($id);
}
// ----------------------------END ACTION DELETE STUFF----------------------------------------

//----------------------------ACTION UPLOAD FILE-----------------------------------------

else if (isset($_GET["action"]) && $_GET["action"] == "uploadFile")
{
    $id = $_GET["id_film"];
    $file = $_FILES;
    var_dump($_FILES);
    uploadFile($file,$id);
}

//-----------------------------------END ACTION UPLOAD FILE ------------------------------------

//-------------------------------MISC--------------------------------------------------

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

// ---------------------------------DEFAULT--------------------------------

else //page when landing on site 
{
    displayFilms();
}

