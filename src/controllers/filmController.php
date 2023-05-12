<?php 

require ("src/models/filmModel.php");
require ("src/controllers/math.php");
function displayFilms()
{
    $filmsList = getFilms(); 
    require("views/templates/filmListing.php");
}

function updateFilms($filmData, $idZ)
{
    $permission = false;                                            //Setting a value that we will turn to true after verification
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
                    $permission = true;
                    break;
                
                case "duree_film": //We need to check if user put correct form format. But DB has only films in minuts
                    $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //so we have to do conversion. Here sanitizing
                    if (preg_match("/^\d{2}:\d{2}$/", $filteredValue)) //If the pattern of the string is :"1 number, 1 number, semi column,
                        {                                                  //, one number, one number
                            $filteredValue = filterFourNumbers($filteredValue);
                            $filmData[$fieldName] = $filteredValue;
                            $permission = true;
                        }
                    else if (preg_match("/^\d{1}:\d{2}$/", $filteredValue)) 
                        {
                            $filteredValue = filterThreeNumbers($filteredValue);
                            $filmData[$fieldName] = $filteredValue;
                            $permission = true;
                        }
                    else
                    {
                            echo "String does not match pattern!";
                            $permission = false;
                            var_dump($permission);                        
                    }
                    break;

                default:
                    $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $filmData[$fieldName] = $filteredValue;
                    echo ("Filtered named fields");
                    $permission = true;
                    break;                 
            }
        }
        if ($permission)
        {
            updateFilmsModel($filmData, $idZ);
            header("Location:index.php?action=displayFilms");
        }
    }
    else
    {

    }
}
