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

function addcasting($castingData)
{
    $permission1 = false;
    $permission2 = false;
    $permission3 = false;
    $ids = [];
    $filteredCastingData = filter_var($castingData,FILTER_SANITIZE_FULL_SPECIAL_CHARS);     //Strategy to add array = checking if imputs matches the first existsting value having an 
    $castings = getCastings();                                                              //existing if for each then we allow to execute the add function. Ir's an alternative version to
    foreach ($castings as $casting)                                                         //ensure user puts always existing data 
    {
        if ($casting["titre_film"] == $castingData["titre_film"])
        { 
            $permission1 = true;
            $ids[] = $casting["id_film"];
            break;
        }
    }
    foreach ($castings as $casting)     
    {
        if ($casting["nom"] == $castingData["nom"] && $casting["prenom"] == $castingData["prenom"])
        {
            echo "HIHHH";
            $permission2 = true;
            $ids[] = $casting["id_acteur"];
            break;
        }
    }
    foreach ($castings as $casting)     
    {
        if ($casting["nom_role"] == $castingData["nom_role"])
        {
            $permission3 = true;
            $ids[] = $casting["id_role"];
            break;
        }
    }
    var_dump($casting["nom_role"]);
    var_dump($castingData["nom_role"]);
    var_dump($permission1);
    var_dump($permission2);
    var_dump($permission3);
    var_dump($ids);

    if ($permission1 && $permission2 && $permission3) addCastingModel($ids);

}
function deletecasting($id)
{
    deleteCastingModel($id);
}