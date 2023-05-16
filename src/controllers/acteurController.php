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
    $transformation = ["H" => "Homme", "F" => "Femme", "A" => "Autre"]; //If user put a correct input like "h" "f" or "a"
                                                                        //we will use this array to transform string b/c full array is prettier
    $permission = false;
    var_dump($dataActeurs);
    foreach ($dataActeurs as $fieldname=>$value)
    {
        $filteredDataActeurs = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        switch ($fieldname)
        {
            case $fieldname == "dateDeNaissance":
                $dateObj = DateTime::createFromFormat('Y-m-d', $filteredDataActeurs); //Checking good data format
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
                if (in_array(mb_strtolower($filteredDataActeurs),$authorizedSexStrings)) //We get rid of case sensivity problem
                {
                    echo "test ok";
                    $filteredDataActeurs = ucfirst(strtolower($filteredDataActeurs));     //value displayed as UPPERCASElowercase-- I like having the final output as "Homme"
                    if (array_key_exists($filteredDataActeurs, $transformation))          //"Femme" or "Autre"  
                    $filteredDataActeurs = $transformation[$filteredDataActeurs];         //So i check if the the input is "h" "f" or "a" and transform
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
    $permission == true ? updateActeurModel($filteredDataActeurs,$id,$fieldname) : null ;
    echo "---------fieldname-------";
    var_dump($fieldname);
    echo "----------Value---------";
    var_dump($value);
    echo "--------FILTEREDVALUE--------";
    var_dump($filteredDataActeurs);
//We need to keep in mind we are working with a filtered value  comming from a string
                                                            //3 args so we retain the fieldname
}

function addActeur($acteurData)
{
    $permission = true;                                //Another method of filtering using filter_var_array instead of
    $filters = [                                        //foreaching through all of the field and adding filtered values to a new array
        "nom" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,    //like an idiot 
        "prenom" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "dateDeNaissance" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "sexe" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ];
    $filteredActeurData = filter_var_array($acteurData,$filters);
    $dateObj = DateTime::createFromFormat('Y-m-d', $filteredActeurData["dateDeNaissance"]);
    if (!$dateObj) $permission = false;          //If the creation of object DateTime is false it means the user put wrong format
    $authorizedSexStrings = ["h","f","a","homme","femme","autre"];      //We want the user to only put that
    if (in_array(mb_strtolower($filteredActeurData),$authorizedSexStrings)) //We get rid of case sensivity problem
    

    if ($permission){
        addActeurModel($filteredActeurData);
    }
    else{
    echo "Error";
    }
}

function deleteActeur($id)
{
    deleteActeurModel($id);
    header("Location:index.php?action=displayActeurs");
}
