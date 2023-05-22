<?php
// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
require_once("src/controllers/acteurController.php");
require_once("src/controllers/filmController.php");
require_once("src/controllers/synopsisController.php");
require_once("src/controllers/realController.php");
require_once("src/controllers/roleController.php");
require_once("src/controllers/genreController.php");
require_once("src/controllers/castingController.php");
require_once("src/controllers/homepageController.php");
require_once("src/controllers/afficheController.php");
require_once("src/controllers/statsFilmsController.php");
require_once("src/controllers/statsRealsController.php");
require_once("src/controllers/filmsGenresController.php");

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

if (isset($_GET["action"]) &&  $_GET["action"] == "updateCasting")
{   
    $dataCasting = $_POST;
    $id = $_GET["id_film"];
    $champ_casting= $_GET["champ_casting"];
    updateCasting($dataCasting, $id, $champ_casting);
}

if (isset($_GET["action"]) &&  $_GET["action"] == "updateFilmGenre")
{   
    $oldID = $_GET["oldID"];
    $id_genre = $_POST["id_genre"];
    $id_film = $_GET["id"];
    updateFilmGenre($id_genre,$id_film,$oldID);
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
else if (isset($_GET["action"]) && $_GET["action"] == "displayCastings")
{
    displayCastings();
}
else if (isset($_GET["action"]) && $_GET["action"] == "displayStatsFilms")
{
    displayStatsFilms();
}
else if (isset($_GET["action"]) && $_GET["action"] == "displayStatsReals")
{
    displayStatsReals();
}
else if (isset($_GET["action"]) && $_GET["action"] == "displayFilmsGenres")
{
    displayFilmsGenres();
}
//------------------END ACTION DISPLAY-----------------------------------------------

//-------------------------ACTIONS ADD STUFF ----------------------------------

else if (isset($_GET["action"]) && $_GET["action"] == "addFilm")
{
    $filmData = $_POST;
    $fileData = $_FILES;
    addFilm($filmData,$fileData);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addActeur")
{
    $actorData = $_POST;
    addActeur($actorData);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addReal")
{
    $realData = $_POST;
    addReal($realData);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addRole")
{
    $roleData = $_POST;
    addRole($roleData);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addGenre")
{
    $genreData = $_POST;
    addGenre($genreData);
}

else if (isset($_GET["action"]) && $_GET["action"] == "addCasting")
{
    $castingData = $_POST;
    addCasting($castingData);
}
else if (isset($_GET["action"]) && $_GET["action"] == "addFilmGenre")
{
    $id_film = $_POST["id_film"];
    $id_genre = $_POST["id_genre"];
    var_dump($id_film);
    var_dump($id_genre);
    addFilmGenreData($id_film,$id_genre);
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
else if (isset($_GET["action"]) && $_GET["action"] == "deleteCasting")
{
    $id_film = $_GET["id_film"];
    $id_acteur = $_GET["id_acteur"];
    $id_role = $_GET["id_role"];
    deleteCasting($id_film, $id_acteur, $id_role);
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
else if (isset($_GET["action"]) && $_GET["action"] == "goToAffiche")
{
    $id = $_GET["id"];
    displayAffiche($id);
}

else if (isset($_GET["action"]) && $_GET["action"] == "getRealsStats")
{
    $id = $_POST["id_realisateur"];
    displayStatsOneReal($id);
}

else if (isset($_GET["action"]) && $_GET["action"] == "getRealsStatsActorCheck")
{
    $id = $_POST["id_realisateur"];
    displayStatsOneRealIsActor($id);
}
// ---------------------------------DEFAULT : HOMEPAGE--------------------------------

else //page when landing on site 
{
    landingOnWebsite();
}

