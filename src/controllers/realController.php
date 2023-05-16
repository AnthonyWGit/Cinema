<?php 
require_once "src/models/realisateurModel.php";

function displayReals()
{
    $realisateurs = getRealisateurs();
    require_once "views/templates/realsListing.php";
}

function updateReal($dataReals,$id)
{
    $authorizedSexStrings = ["h","f","a","homme","femme","autre"];      //We want the user to only put that
    $transformation = ["H" => "Homme", "F" => "Femme", "A" => "Autre"]; //If user put a correct input like "h" "f" or "a"
                                                                        //we will use this array to transform string b/c full array is prettier
    $permission = true;
    var_dump($dataReals);
    foreach ($dataReals as $fieldname=>$value)
    {
        $filteredDataReals = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        switch ($fieldname)
        {
            case $fieldname == "dateDeNaissance":
                $dateObj = DateTime::createFromFormat('Y-m-d', $filteredDataReals); //Checking good data format
                if ($dateObj) //is true if we created the object it means used has good input 
                {
                    var_dump($dateObj);
                    echo "text Ok";
                    $permission = true;
                    break;                    
                }
                else        //user trolled 
                {
                    var_dump($dateObj);
                    $permission = false;
                    echo "test not ok";
                    break;
                }

            case $fieldname == "sexe";
                if (in_array(mb_strtolower($filteredDataReals),$authorizedSexStrings)) //We get rid of case sensivity problem
                {
                    echo "test ok";
                    $filteredDataReals = ucfirst(strtolower($filteredDataReals));     //value displayed as UPPERCASElowercase-- I like having the final output as "Homme"
                    if (array_key_exists($filteredDataReals, $transformation))          //"Femme" or "Autre"  
                    $filteredDataReals = $transformation[$filteredDataReals];         //So i check if the the input is "h" "f" or "a" and transform
                    $permission = true;
                    break;
                }
                
                else
                {
                    echo "test not ok";
                    $permission = false;
                    break;
                }
            default:
                $permission = true;
                break;
        }
    }
    $permission == true ? updateRealModel($filteredDataReals,$id,$fieldname) : null ;
    header("Location:index.php?action=displayReals");

//We need to keep in mind we are working with a filtered value  comming from a string
                                                            //3 args so we retain the fieldname
}

function addReal($realData)
{
    $authorizedSexStrings = ["h","f","a","homme","femme","autre"];      //We want the user to only put that
    $transformation = ["H" => "Homme", "F" => "Femme", "A" => "Autre"]; //If user put a correct input like "h" "f" or "a"
                                                                        //we will use this array to transform string b/c full array is prettier
    $permission = false;
    foreach ($realData as $fieldname=>$value)
    {
        $filteredDataReals = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        switch ($fieldname)
        {
            case $fieldname == "dateDeNaissance":
                $dateObj = DateTime::createFromFormat('Y-m-d', $filteredDataReals); //Checking good data format
                if ($dateObj) //is true if we created the object it means used has good input 
                {
                    var_dump($dateObj);
                    echo "text Ok";
                    $permission = true;
                    break;                    
                }
                else        //user trolled 
                {
                    var_dump($dateObj);
                    $permission = false;
                    echo "test not ok";
                    break;
                }

            case $fieldname == "sexe";
                if (in_array(mb_strtolower($filteredDataReals),$authorizedSexStrings)) //We get rid of case sensivity problem
                {
                    echo "test ok";
                    $filteredDataReals = ucfirst(strtolower($filteredDataReals));     //value displayed as UPPERCASElowercase-- I like having the final output as "Homme"
                    if (array_key_exists($filteredDataReals, $transformation))          //"Femme" or "Autre"  
                    $filteredDataReals = $transformation[$filteredDataReals];         //So i check if the the input is "h" "f" or "a" and transform
                    $permission = true;
                    break;
                }
                
                else
                {
                    echo "test not ok";
                    $permission = false;
                    break;
                }
            default:
                $permission = true;
                break;
        }
    }
    $permission == true ? addRealModel($filteredDataReals) : null ;
    var_dump($filteredDataReals);
//We need to keep in mind we are working with a filtered value  comming from a string
                                                            //3 args so we retain the fieldname
}

// function deleteReal($id)
// {
//     deleteActeurReal($id);
//     header("Location:index.php?action=displayReals");
// }
