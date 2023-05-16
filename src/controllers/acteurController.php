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
    if ($dateObj) $permission == false;
    var_dump($filteredActeurData);
    if ($permission) addActeurModel($filteredActeurData);
}

function deleteActeur($id)
{
    deleteActeurModel($id);
}
