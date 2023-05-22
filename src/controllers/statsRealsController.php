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
    require_once("views/templates/statsReals.php");
}

function displayStatsOneReal($id)
{
    $dataReal = getStatsRealOne($id);
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
    require_once("views/templates/statsReals.php");
}