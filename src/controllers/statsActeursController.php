<?php 
require_once ("src/models/acteurModel.php");
require_once ("src/models/statsActeursModel.php");

function displayStatsActeurs()
{
    $statsActeurs = getStatsActeurs();
    $allActeurs = getActeurs();
    $arrayFilm = [];
    foreach ($allActeurs as $acteur) //This will be used for the dropdown to add director when creating new row
    {
        $acteursList[$acteur["id_acteur"]] = [
            "name" => $acteur["nom"],
            "forename" => $acteur["prenom"],
            "id" => $acteur["id_acteur"]
        ];
    }

    $actorsSex = getStatsSex();
    var_dump($actorsSex);
    require_once("views/templates/statsActeurs.php");
}

function displayFilmActor($id)
{
    $arrayFilm = [];                        //Array containing values we want to display 
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

    $acteurPlayedFilm = getStatsFilmActor($id);

    foreach ($acteurPlayedFilm as $film)
    {
        $arrayFilm[$film["id_film"]] = ["titre_film" => $film["titre_film"]];
    }
    require_once("views/templates/statsActeurs.php");
}