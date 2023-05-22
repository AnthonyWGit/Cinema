<?php 
require_once ("src/models/realisateurModel.php");
require_once ("src/models/statsRealsModel.php");

function displayStatsReals()
{
    $data = getStatsReals();
    $allReals = getRealisateurs();
    $realsArray=[];
    foreach ($allReals as $real) //This will be used for the dropdown to add director when creating new row
    {
        $realisateursList[$real["id_realisateur"]] = [
            "name" => $real["nom"],
            "forename" => $real["prenom"],
            "id" => $real["id_realisateur"]
        ];
    }
    $infosIsActor ="";      //Without this line there will be an error $isActor not defined
    require_once("views/templates/statsReals.php");
}

function displayStatsOneReal($id)
{
    $numberOfMovies = getStatsRealOne($id);
    $data = getStatsReals();
    $allReals = getRealisateurs();
    $realsArray=[];
    foreach ($allReals as $real) //This will be used for the dropdown to select director
    {
        $realisateursList[$real["id_realisateur"]] = [
            "name" => $real["nom"],
            "forename" => $real["prenom"],
            "id" => $real["id_realisateur"]
        ];
    }
    require_once("views/templates/statsReals.php");
}

function displayStatsOneRealIsActor($id)
{
    $isActorToo = getStatsRealOneisActor($id);
    $data = getStatsReals();
    $allReals = getRealisateurs();
    $realsArray=[];
    $infosIsActor = "";
    foreach ($allReals as $real) //This will be used for the dropdown to select directors in DB 
    {
        $realisateursList[$real["id_realisateur"]] = [
            "name" => $real["nom"],
            "forename" => $real["prenom"],
            "id" => $real["id_realisateur"]
        ];
    }
    // !empty($isActorToo) ? $isActorToo[0]["nom"]." a joué dans au moins un de ses films." : $realisateursList[$id]["name"]. " a joué dans aucun film.";

    if (!empty($isActorToo))
    {
        $infosIsActor = $isActorToo[0]["nom"]." a joué dans au moins un de ses films.";
        foreach ($isActorToo as $titreFilm)
        {
            $infosIsActor .= "<li>". $titreFilm["titre_film"]. "</li>";
        }
    }
    else
    {
        $infosIsActor = $realisateursList[$id]["name"]. " a joué dans aucun film";
    }
    require_once("views/templates/statsReals.php");
}