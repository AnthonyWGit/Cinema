<?php 

require ("src/models/filmModel.php");
function displayFilms()
{
    $filmsList = getFilms(); 
    require("views/templates/filmListing.php");
}

function updateFilms($filmData, $idZ)
{
    if (isset($filmData) && !empty(array_filter($filmData)))        //Checking if the user put something in the form. Using array_filter
    {                                                               //because $filmData is an array
        foreach ($filmData as $fieldName => $value)
        {                                       //Need the following switch case to the filter different dataTypes
            switch ($fieldName)
            {
                case "dateSortie_film":
                    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    $filmData[$fieldName] = $filteredValue;
                    echo("Filtered dateSortie");
                    break;
                    
                default:
                    $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $filmData[$fieldName] = $filteredValue;
                    echo ("Filtered named fields");
                    break;                 
            }
        }
        updateFilmsModel($filmData, $idZ);        
    }
    else
    {

    }

}
