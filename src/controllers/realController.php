<?php 
// require_once ("src/models/realisateurModel.php");

namespace Controllers;
use Models\Connect;

class RealController
{
    public function displayReals()
    {
        //-----------------SQL PART----------------------------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM realisateur INNER JOIN personne ON realisateur.id_personne = personne.id_personne'; //priceF means priceFormated
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $reals = $stmt->fetchAll();

        //-------------------------------------------------------------------------------------
        require "views/templates/realsListing.php";
    }
    public function updateReal($dataReals,$id)
    {
        //----------INITIALIZATION-------------------------------------
        $authorizedSexStrings = ["h","f","a","homme","femme","autre"];      //We want the user to only put that
        $transformation = ["H" => "Homme", "F" => "Femme", "A" => "Autre"]; //If user put a correct input like "h" "f" or "a"
                                                                            //we will use this array to transform string b/c full array is prettier
        $permission = false;                                                                        
        //----------END INITIALIZATION------------------------------------
        //METHOD ONE : 
        foreach ($dataReals as $fieldname=>$value)
        {
            $filteredDataReals = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            switch ($fieldname)
            {
                case $fieldname == "dateDeNaissance":
                    $dateObj = \DateTime::createFromFormat('Y-m-d', $filteredDataReals); //Checking good data format
                    if ($dateObj) //is true if we created the object it means used has good input 
                    {
                        var_dump($dateObj);
                        echo "text Ok";
                        $permission = true;
                        break;                    
                    }
                    else        //user trolled 
                    {
                        echo "test not ok";
                        break;
                    }
                case $fieldname == "sexe";
                    if (in_array(mb_strtolower($filteredDataReals),$authorizedSexStrings)) //We get rid of case sensivity problem
                    {
                        echo "test ok";
                        $filteredDataReals = ucfirst(strtolower($filteredDataReals));    //Il like having                                  //value displayed as UPPERCASElowercase
                                                                                            //value displayed as UPPERCASElowercase--
                        if (array_key_exists($filteredDataReals, $transformation))         //"Femme" or "Autre"  
                        {
                            $filteredDataReals = $transformation[$filteredDataReals];         //So i check if the the input is "h" "f" or "a" and transform                        
                        }
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
        if($permission)
        {
            //----------------------------------SQL PART--------------------------------
            $mySQLconnection = Connect::connexion();
            $sqlQuery = 'UPDATE realisateur INNER JOIN personne ON realisateur.id_personne=personne.id_personne 
                        SET '. $fieldname . ' = :'.$fieldname.' WHERE id_realisateur = :id_realisateur';
            $stmt = $mySQLconnection->prepare($sqlQuery);
            $stmt->bindValue($fieldname, $filteredDataReals);
            $stmt->bindValue('id_realisateur',$id,\PDO::PARAM_INT);
            var_dump($stmt);
            $stmt->execute();
            unset($mySQLconnection);
            header("Location:index.php?action=displayReals");      
            //----------------------------------------------------------------------------  
        }
        else
        {
            echo "Error";
        }
    }



    public function addReal($realData)
    {

        //------------- INITIALIZATION VAR--------------------------------
        $authorizedSexStrings = ["h","f","a","homme","femme","autre"];      //We want the user to only put that
        $transformation = ["H" => "Homme", "F" => "Femme", "A" => "Autre"]; //If user put a correct input like "h" "f" or "a"
        $permission = true;                                //Another method of filtering using filter_var_array instead of
        $filters = [                                        //foreaching through all of the field and adding filtered values to a new array
            "nom" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,    //like an idiot 
            "prenom" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            "dateDeNaissance" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            "sexe" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ];
        //-----------------SANITIZING-------------------------------------
        $filteredRealData = filter_var_array($realData,$filters);
        $sexeInput = mb_strtolower($filteredRealData["sexe"]);       
        //-----------------END INTIALIZATION VAR--------------------------    
        //-----------------CHEKING DATE FORMAT
        $dateObj = \DateTime::createFromFormat('Y-m-d', $filteredRealData["dateDeNaissance"]);
        if (!$dateObj) $permission = false;          //If the creation of object DateTime is false it means the user put wrong format    
        //-----------------CHECKING SEX------------------------

        if (in_array($sexeInput,$authorizedSexStrings)) //We get rid of case sensivity problem
        {
            echo "test ok-------". var_dump($filteredRealData["sexe"]);
            $sexeInput = ucfirst($sexeInput);     //value displayed as UPPERCASElowercase-- I like having the final output as "Homme"
            if (array_key_exists($sexeInput, $transformation))          //"Femme" or "Autre"  
            {
                $filteredRealData["sexe"] = $transformation[$sexeInput];         //So i check if the the input is "h" "f" or "a" and transform
                $permission = true;            
            }
        }
        else
        {
            $permission = false;
            echo "Error";
        }
        //-------------------------ACTION ---------------------------
        if ($permission){
            //-------------------------SQL------------------------------

            $nom = "";
            $mySQLconnection = Connect::connexion();
            $sqlQuery = "INSERT INTO personne (personne.nom, personne.prenom, personne.dateDeNaissance, personne.sexe)
                        VALUES (:nom, :prenom, :dateDeNaissance, :sexe)";
            $fieldNameValues = [];
            foreach ($realData as $fieldName=>$value)
            {
                $fieldNameValues[$fieldName] = $value;
                if ($fieldName == "nom")
                $nom = $value;
            }
            $stmt = $mySQLconnection->prepare($sqlQuery);
            $stmt->execute($fieldNameValues);           //Here below the entry in personne is created 
            $sqlQuery = "INSERT INTO realisateur (realisateur.id_personne)
                        SELECT personne.id_personne FROM personne WHERE personne.nom = :nom";
            $stmt = $mySQLconnection->prepare($sqlQuery);
            $stmt->bindValue(":nom",$nom);
            $stmt->execute();                           //and here is where we create a new id actor associated with the id person 

            //---END SQL-----------------------------------------------
            header("Location:index.php?action=displayReals");
        }
        else{
        echo "Error";
        }
    }
    public function deleteReal($id)
    {
        //------------------------------SQL PART--------------------------------------------
        $mySQLconnection = Connect::connexion(); //Below innerjoin because we need to delete date in personne table and the id linked with the 
        //personne entry so we doin a join
        //Deleting associated films first to avoid errors      
        $sql = 'DELETE FROM film
        WHERE id_realisateur = :id_realisateur';
        $stmt = $mySQLconnection->prepare($sql);
        $stmt->bindValue(':id_realisateur',$id,\PDO::PARAM_INT);
        $stmt->execute();

        $sqlQuery = 'DELETE realisateur, personne
        FROM realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        WHERE realisateur.id_realisateur = :id_realisateur';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':id_realisateur',$id, \PDO::PARAM_INT);
        $stmt->execute();
        //--------------------------------------------------------------------------------------
        header("Location:index.php?action=displayReals");
    }    
}
