<?php 
require_once ("src/models/acteurModel.php");
require_once ("src/models/statsActeursModel.php");

function displayStatsActeurs()
{
    $emptyMsg = "";
    $statsActeurs = getStatsActeurs();
    $allActeurs = getActeurs();
    $arrayFilmActeur = [];
    foreach ($allActeurs as $acteur) //This will be used for the dropdown to add director when creating new row
    {
        $acteursList[$acteur["id_acteur"]] = [
            "name" => $acteur["nom"],
            "forename" => $acteur["prenom"],
            "id" => $acteur["id_acteur"]
        ];
    }

    $actorsSex = getStatsSex();
    require_once("views/templates/statsActeurs.php");
}

function displayFilmActor($id)
{
    $arrayFilmActeur = [];                        //Array containing values we want to display 
    $actorsSex = getStatsSex();
    $statsActeurs = getStatsActeurs();
    $allActeurs = getActeurs();
    foreach ($allActeurs as $acteur) //This will be used for the dropdown to add director when creating new row
    {
        $acteursList[$acteur["id_acteur"]] = [
            "name" => $acteur["nom"],
            "forename" => $acteur["prenom"],
            "id" => $acteur["id_acteur"]
        ];
    }
    $emptyMsg = "L'acteur/L'actrice n'a joué dans aucun film";
    $acteurPlayedFilm = getStatsFilmActor($id);

    foreach ($acteurPlayedFilm as $film)
    {
        $arrayFilmActeur[$film["id_film"]] = ["titre_film" => $film["titre_film"]];
    }
    require_once("views/templates/statsActeurs.php");
}