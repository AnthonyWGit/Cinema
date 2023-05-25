<?php


// This page is a test. It will be the controller for a page i'll do later. It's the one for controlview
//** *********************LISTINGS CONTROLLERS********************** */
require_once("src/controllers/acteurController.php");
require_once("src/controllers/filmController.php");
require_once("src/controllers/synopsisController.php");
require_once("src/controllers/realController.php");
require_once("src/controllers/roleController.php");
require_once("src/controllers/genreController.php");
require_once("src/controllers/castingController.php");
require_once("src/controllers/homepageController.php");
require_once("src/controllers/afficheController.php");

//*************************END LISTINGS CONTROLLERS***************** */

 //******************** STATS CONTROLLER*********************** */
require_once("src/controllers/statsFilmsController.php");
require_once("src/controllers/statsRealsController.php");
require_once("src/controllers/statsActeursController.php");
require_once("src/controllers/statsGenresController.php");
require_once("src/controllers/statsRolesAndCastingsController.php");
//********************** END STATS CONTROLLER******************* */

//***********************MODELS */

require_once ("src/models/statsGenresModel.php");
//*************************************END******* */

use Controllers\FilmController;
use Controllers\FilmsGenreController;
use Controllers\GenreController;
use Controllers\ActeurController;
use Controllers\AfficheController;
use Controllers\CastingController;

spl_autoload_register(function ($class_name)
{
    include 'src\\'.$class_name . '.php';
});

$controllerGenre = new GenreController();
$controllerFilmsGenre = new FilmsGenreController();
$controllerFilm = new FilmController();
$controllerActeur = new ActeurController();
$controllerAffiche = new AfficheController();
$controllerCasting = new CastingController();

//---------------------- ACTIONS UPDATE---------------------------------------

if (isset($_GET["action"]))
{
    switch($_GET["action"])
    {
        case "updateFilms":
            $dataFilm = $_POST;
            $idZ = $_GET["id_film"];
            $controllerFilm->updateFilms($dataFilm, $idZ);
            break;

        case "updateActeur":
            $dataActeurs = $_POST;
            $id = $_GET["id_acteur"];
            $controllerActeur->updateActeur($dataActeurs, $id);
            break;
        case "updateRealisateur":
            $dataReals = $_POST;
            $id = $_GET["id_real"];
            updateReal($dataReals, $id); 
            break;
        case "updateRole":
            $dataRoles = $_POST;
            $id = $_GET["id_role"];
            updateRole($dataRoles, $id);   
        case "updateGenre":
            $dataGenres = $_POST;
            $id = $_GET["id_genre"];
            $controllerGenre->updateGenre($dataGenres, $id);     
            break;
        case "updateCasting":
            $dataCasting = $_POST;
            $id = $_GET["id_film"];
            $champ_casting= $_GET["champ_casting"];
            $controllerCasting->updateCasting($dataCasting, $id, $champ_casting); 
            break;    
        case "updateFilmGenre";
            $oldID = $_GET["oldID"];
            $id_genre = $_POST["id_genre"];
            $id_film = $_GET["id"];
            $controllerFilmsGenre->updateFilmGenre($id_genre, $id_film, $oldID);   
            break; 
//--------------------END ACTIONS UPDATE ---------------------------------------

//----------------------ACTIONS DISPLAY -----------------------------------------            
        case "displayFilms":
            $controllerFilm->displayFilms();
            break;
        case "displayActeurs":
            $controllerActeur->displayActeurs();
            break;
        case "displayReals":
            displayReals();
            break;
        case "displayRoles";
            displayRoles();
            break;
        case "displayGenres":
            $controllerGenre->displayGenres();
            break;
        case "displayCastings":
            $controllerCasting->displayCastings();
            break;
        case "displayFilmsGenres":
            $controllerFilmsGenre->displayFilmsGenres();
            break;
        case "displayStatsFilms":
            displayStatsFilms();
            break;
        case "displayStatsReals":
            displayStatsReals();
            break;
        case "displayStatsActeurs":
            displayStatsActeurs();
            break;
        case "displayStatsGenres":
            $display = new StatsGenreController();
            $display->displayStatsGenres();
            break;
        case "displayStatsRoles":
        case "displayStatsCastings":
            displayVoid();
            break;
//------------------END ACTION DISPLAY-----------------------------------------------

//-------------------------ACTIONS ADD STUFF ----------------------------------
        case "addFilm":
            $filmData = $_POST;
            $fileData = $_FILES;
            $controllerFilm->addFilm($filmData,$fileData);
            break;
        case "addActeur":
            $actorData = $_POST;
            $controllerActeur->addActeur($actorData);        
            break;
        case "addReal":
            $realData = $_POST;
            addReal($realData);
            break;
        case "addRole":
            $roleData = $_POST;
            addRole($roleData);       
            break;
        case "addGenre":
            $genreData = $_POST;
            $controllerGenre->addGenre($genreData);
            break;
        case "addCasting":
            $castingData = $_POST;
            $controllerCasting->addCasting($castingData);
            break;
        case "addFilmGenre":
            $id_film = $_POST["id_film"];
            $id_genre = $_POST["id_genre"];
            $controllerFilmsGenre->addFilmGenreData($id_film,$id_genre);
            break;
//----------------------------------END ACTIONS ADD STUFF ----------------------------

//------------------------------ACTION DELETE STUFF-------------------------------------
        case "deleteFilm":
            $id = $_GET["id_film"];
            $controllerFilm->deleteFilm($id);      
            break;
            
        case "deleteActeur":
            $id = $_GET["id_acteur"];
            $controllerActeur->deleteActeur($id); 
            break;
        case "deleteReal":
            $id = $_GET["id_real"];
            deleteReal($id);    
            break;
        case "deleteRole":
            $id = $_GET["id_role"];
            deleteRole($id);
            break;
        case "deleteGenre":
            $id = $_GET["id_genre"];
            $controllerGenre->deleteGenre($id);      
            break;    
        case "deleteCasting":
            $id_film = $_GET["id_film"];
            $id_acteur = $_GET["id_acteur"];
            $id_role = $_GET["id_role"];
            $controllerCasting->deleteCasting($id_film, $id_acteur, $id_role);
            break;
        case "deleteFilmGenre":
            $id_film = $_GET["id_film"];
            $id_genre = $_GET["id_genre"];
            $controllerFilmsGenre->deleteFilmGenre($id_film,$id_genre);     
            break;     
// ----------------------------END ACTION DELETE STUFF----------------------------------------

//----------------------------ACTION UPLOAD FILE-----------------------------------------
        case "uploadFile":
            $id = $_GET["id_film"];
            $file = $_FILES;
            $controllerFilm->uploadFile($file,$id);   
            break;

//-----------------------------------END ACTION UPLOAD FILE ------------------------------------

//-------------------------------MISC--------------------------------------------------

        case "goToSynopsis":
            $id = $_GET["id"];
            displaySynopsis($id);  
            break;
        case "editSynopsis":
            $id = $_GET["id"];
            $textSynopsis = $_POST["textSynopsis"];
            editSynopsis($textSynopsis, $id);     
            break;
        case "goToAffiche":
            $id = $_GET["id"];
            $controllerAffiche->displayAffiche($id);    
            break;
        case "getRealsStats":
            $id = $_POST["id_realisateur"];
            displayStatsOneReal($id);        
            break;
        case "getRealsStatsActorCheck":
            $id = $_POST["id_realisateur"];
            displayStatsOneRealIsActor($id);
            break;
        case "getActorFilm"://USED TO DISPLAY WICH ACTOR HAS PLAYED IN WICH FILM 
            $id = $_POST["id_acteur"];
            displayFilmActor($id); 
            break;                                    
    }
}
// ---------------------------------DEFAULT : HOMEPAGE--------------------------------
else //page when landing on site 
{
    landingOnWebsite();
}