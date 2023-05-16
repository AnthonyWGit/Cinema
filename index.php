<?php
// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
require_once("src/controllers/acteurController.php");
require_once("src/controllers/filmController.php");
require_once("src/controllers/synopsisController.php");
require_once("src/controllers/realController.php");
require_once("src/controllers/roleController.php");
require_once("src/controllers/genreController.php");

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
    $id = $_GET["id_real"];
    updateReal($dataReals, $id);
}

if (isset($_GET["action"]) &&  $_GET["action"] == "updateRole")
{   
    $dataRoles = $_POST;
    $id = $_GET["id_role"];
    updateRole($dataRoles, $id);
}

if (isset($_GET["action"]) &&  $_GET["action"] == "updateGenre")
{   
    $dataGenres = $_POST;
    $id = $_GET["id_genre"];
    updateGenre($dataGenres, $id);
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
else if (isset($_GET["action"]) && $_GET["action"] == "displayRoles")
{
    displayRoles();
}
else if (isset($_GET["action"]) && $_GET["action"] == "displayGenres")
{
    displayGenres();
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

else if (isset($_GET["action"]) && $_GET["action"] == "addReal")
{
     $realData= $_POST;
     addReal($realData);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addRole")
{
     $roleData= $_POST;
     addRole($roleData);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addGenre")
{
     $genreData= $_POST;
     addGenre($genreData);
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

else if (isset($_GET["action"]) && $_GET["action"] == "deleteReal")
{
    $id = $_GET["id_real"];
    deleteReal($id);
}

else if (isset($_GET["action"]) && $_GET["action"] == "deleteRole")
{
    $id = $_GET["id_role"];
    deleteRole($id);
}

else if (isset($_GET["action"]) && $_GET["action"] == "deleteGenre")
{
    $id = $_GET["id_genre"];
    deleteGenre($id);
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

