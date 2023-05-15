<?php 
require_once ("src/models/acteurModel.php");

function displayActeurs()
{
    $acteurs = getActeurs();
    require "views/templates/acteursListing.php";
}

function updateActeur($dataActeurs,$id)
{
    $authorizedSexStrings = ["h","f","a","homme","femme","autre"];      //We want the user to only put that
    $permission = false;
    var_dump($dataActeurs);
    foreach ($dataActeurs as $fieldname=>$value)
    {
        $filteredDataActeurs = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        switch ($fieldname)
        {
            case $fieldname == "ddN":
                $dateObj = DateTime::createFromFormat('Y-m-d', $filteredDataActeurs); //Checking good data format
                if ($dateObj->format('Y-m-d') === $filteredDataActeurs)
                $permission = true;
                break;
            
            case $fieldname == "sexe";
                if (in_array(mb_strtolower($filteredDataActeurs),$authorizedSexStrings)) //We get rid of case sensivity problem
                {
                    echo "test ok";
                    $filteredDataActeurs = ucfirst(strtolower($filteredDataActeurs));     //Il like having
                    $permission = true;                                     //value displayed as UPPERCASElowercase
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
    $permission==true ? updateActeurModel($filteredDataActeurs,$id,$fieldname) : null ;
    echo "---------fieldname-------";
    var_dump($fieldname);
    echo "----------Value---------";
    var_dump($value);
    echo "--------FILTEREDVALUE--------";
    var_dump($filteredDataActeurs);
//We need to keep in mind we are working with a filtered value  comming from a string
                                                            //3 args so we retain the fieldname
}