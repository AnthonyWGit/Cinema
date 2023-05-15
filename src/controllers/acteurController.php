<?php 
require_once ("src/models/acteurModel.php");

function displayActeurs()
{
    $acteurs = getActeurs();
    require "views/templates/acteursListing.php";
}

function updateActeur($dataActeurs,$id)
{
    var_dump($dataActeurs);
    foreach ($dataActeurs as $fieldname=>$value)
    {
        $filteredDataActeurs = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    echo "---------fieldname-------";
    var_dump($fieldname);
    echo "----------Value---------";
    var_dump($value);
    echo "--------FILTEREDVALUE--------";
    var_dump($filteredDataActeurs);
    updateActeurModel($filteredDataActeurs,$id,$fieldname); //We need to keep in mind we are working with a filtered value  comming from a string
                                                            //3 args so we retain the fieldname
}