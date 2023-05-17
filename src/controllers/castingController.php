<?php 
require_once ('src/models/castingModel.php');

function displayCastings()
{
    $castings = getCastings();
    // $filmsNoDuplicate = [];
    // foreach ($castings as $cast) //This will be used for the dropdown to add director when creating new row
    // {
    //     $filmsNoDuplicate[$cast["id_film"]] = [
    //     "id" => $cast["titre_film"]
    //     ];
    // }
    // $filmsNoDuplicate = array_unique($filmsNoDuplicate, SORT_REGULAR);
    // var_dump($filmsNoDuplicate);
    // $castings["filmNoDuplicate"] = $filmsNoDuplicate;
    require "views/templates/castingListing.php";
}

function updateCasting($dataCasting, $id, $champ_casting)
{
    var_dump($dataCasting);
    foreach ($dataCasting as $fieldName=>$value)    //using foreach to get the fieldName because we will use it in SQL request 
    {
        $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);    //Sanitizing value in array
        $datacasting[$fieldName] = $filteredValue;                                     //replacing original values by sanitized
    }
    updateCastingModel($filteredValue,$id,$fieldName,$champ_casting);
}

// function addcasting($castingData)
// {
//     $filteredcastingData = filter_var($castingData,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//     addcastingModel($filteredcastingData);
// }
// function deletecasting($id)
// {
//     deletecastingModel($id);
// }