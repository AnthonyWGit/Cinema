<?php
//____________________________CONTROLLER MAIN______________________________
use Controllers\FilmController;
use Controllers\FilmsGenreController;
use Controllers\GenreController;
use Controllers\ActeurController;
use Controllers\AfficheController;
use Controllers\HomepageController;
use Controllers\CastingController;
use Controllers\Math;
use Controllers\RealController;
use Controllers\RoleController;
//__________________________CONTROLLERS STATS__________________________
use Controllers\StatsActeursController;
use Controllers\statsFilmsController;
use Controllers\StatsGenreController;
use Controllers\StatsRealsController;
use Controllers\StatsRaCC;
use Controllers\SynopsisController;

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
$controllerHomepage = new HomepageController();
$controllerReal = new RealController();
$controllerRole = new RoleController();
$controllerStatsActeurs = new StatsActeursController();
$controllerStatsGenre = new StatsGenreController();
$controllerStatsReal = new StatsRealsController();
$controllerStatsFilms = new statsFilmsController();
$controllerStatsRaCC = new StatsRaCC();
$controllerSynopsis = new SynopsisController();

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
            $controllerReal->updateReal($dataReals, $id); 
            break;
        case "updateRole":
            $dataRoles = $_POST;
            $id = $_GET["id_role"];
            $controllerRole->updateRole($dataRoles, $id);  
            break; 
        case "updateGenre":
            $dataGenres = $_POST;
            $id = $_GET["id_genre"];
            $controllerGenre->updateGenre($dataGenres, $id);     
            break;
        case "updateCasting":
            $dataCasting = $_POST;
            $id = $_GET["id_film"];
            $id_acteur = $_GET["id_acteur"];
            $champ_casting = $_GET["champ_casting"];
            var_dump($dataCasting);
            $controllerCasting->updateCasting($dataCasting, $id, $id_acteur, $champ_casting); 
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
            $controllerReal->displayReals();
            break;
        case "displayRoles";
            $controllerRole->displayRoles();
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
            $controllerStatsFilms->displayStatsFilms();
            break;
        case "displayStatsReals":
            $controllerStatsReal->displayStatsReals();
            break;
        case "displayStatsActeurs":
            $controllerStatsActeurs->displayStatsActeurs();
            break;
        case "displayStatsGenres":
            $controllerStatsGenre->displayStatsGenres();
            break;
        case "displayStatsRoles":
        case "displayStatsCastings":
            $controllerStatsRaCC->displayVoid();
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
            $controllerReal->addReal($realData);
            break;
        case "addRole":
            $roleData = $_POST;
            $controllerRole->addRole($roleData);       
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
            $controllerReal->deleteReal($id);    
            break;
        case "deleteRole":
            $id = $_GET["id_role"];
            $controllerRole->deleteRole($id);
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
            $controllerSynopsis->displaySynopsis($id);  
            break;
        case "editSynopsis":
            $id = $_GET["id"];
            $textSynopsis = $_POST["textSynopsis"];
            $controllerSynopsis->editSynopsis($textSynopsis, $id);     
            break;
        case "goToAffiche":
            $id = $_GET["id"];
            $controllerAffiche->displayAffiche($id);    
            break;
        case "getRealsStats":
            $id = $_POST["id_realisateur"];
            $controllerStatsReal->displayStatsOneReal($id);        
            break;
        case "getRealsStatsActorCheck":
            $id = $_POST["id_realisateur"];
            $controllerStatsReal->displayStatsOneRealIsActor($id);
            break;
        case "getActorFilm"://USED TO DISPLAY WICH ACTOR HAS PLAYED IN WICH FILM 
            $id = $_POST["id_acteur"];
            $controllerStatsActeurs->displayFilmActor($id); 
            break;                                    
    }
}
// ---------------------------------DEFAULT : HOMEPAGE--------------------------------
else //page when landing on site 
{
    $controllerHomepage->landingOnWebsite();
}