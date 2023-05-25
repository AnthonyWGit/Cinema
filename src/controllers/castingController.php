<?php 
// require_once ('src/models/castingModel.php');

namespace Controllers;
use Models\Connect;

class CastingController
{
    public function getCastings()
    {
        //--------------------------SQL PART-------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM casting 
                    INNER JOIN film ON casting.id_film = film.id_film
                    INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
                    INNER JOIN role ON casting.id_role = role.id_role
                    INNER JOIN personne ON acteur.id_personne = personne.id_personne'; //priceF means priceFormated
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $castings = $stmt->fetchAll();
        //--------------------------------------------------------------
        return $castings;
    }
    public function displayCastings()
    {

        $castings = $this->getCastings();
        require "views/templates/castingListing.php";
    }

    public function updateCasting($dataCasting, $id, $id_acteur,$champ_casting)
    {
        foreach ($dataCasting as $fieldName=>$value)    //using foreach to get the fieldName because we will use it in SQL request 
        {
            $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);    //Sanitizing value in array
            $datacasting[$fieldName] = $filteredValue;                                     //replacing original values by sanitized
        }
//______________________________________________________________________
        //------------SPECIAL CASE ABOUT ACTORS --------------------------
        if (isset($id_acteur) && !empty($id_acteur))    //Actor is special case because we have to use the name and forename to retrive associated id
        {
            $mySQLconnection = Connect::connexion();             //there is no id_casting so to target a specific row we will point at the old value at :cahmp_casting
            $sqlQuery = 'SELECT * FROM personne INNER JOIN acteur ON personne.id_personne = acteur.id_personne
                        WHERE nom = :nom
                        AND prenom = :prenom';
            $stmt =  $mySQLconnection->prepare($sqlQuery);
            $stmt->bindValue(':prenom',$dataCasting["prenom"]);
            $stmt->bindValue(':nom',$dataCasting["nom"]);
            $stmt->execute();
            $newActorId = $stmt->fetch(\PDO::FETCH_ASSOC);
            $newActorId = $newActorId["id_acteur"];
            
            $mySQLconnection = Connect::connexion();             //there is no id_casting so to target a specific row we will point at the old value at :cahmp_casting
            $sqlQuery = 'UPDATE casting 
                        INNER JOIN film ON casting.id_film = film.id_film
                        INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
                        INNER JOIN role ON casting.id_role = role.id_role
                        INNER JOIN personne ON acteur.id_personne = personne.id_personne 
                        SET casting.id_acteur = :placeholder
                        WHERE casting.id_acteur = :champ_casting';
            $stmt =  $mySQLconnection->prepare($sqlQuery);
            $stmt->bindValue(':placeholder',$newActorId);
            $stmt->bindValue(':champ_casting',$id_acteur);
            $stmt->execute();
            unset($stmt);
        }
//_____________________________________________________________________________________
        //------------------------SQL PART---------------------------------------------
        $mySQLconnection = Connect::connexion();             //there is no id_casting so to target a specific row we will point at the old value at :cahmp_casting
        $sqlQuery = 'UPDATE casting 
                    INNER JOIN film ON casting.id_film = film.id_film
                    INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
                    INNER JOIN role ON casting.id_role = role.id_role
                    INNER JOIN personne ON acteur.id_personne = personne.id_personne 
                    SET '.$fieldName.' = :placeholder
                    WHERE '.$fieldName.' = :champ_casting';
        $stmt =  $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':placeholder',$filteredValue);
        $stmt->bindValue(':champ_casting',$champ_casting);
        $stmt->execute();
        unset($stmt);

        //-------------------------END SQL---------------------------------------------
    }
    public function addCasting($castingData)
    {
        $permission1 = false;
        $permission2 = false;
        $permission3 = false;
        //$castingsRightJoinFilm = getCastingsRightJoinFilm();

        //---------------------------SQL PART CRF -------------------------

        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM casting 
                    RIGHT JOIN film ON casting.id_film = film.id_film'; //priceF means priceFormated
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $castingsRightJoinFilm = $stmt->fetchAll();

        //--------------------------   END SQL CRF ------------------------------------

        // $castingsRightJoinActors = getCastingsRightJoinActors();

        //-------------------SQL PART CRA ---------------------------------

        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM casting 
                    RIGHT JOIN acteur ON casting.id_acteur = acteur.id_acteur
                    INNER JOIN personne ON acteur.id_personne = personne.id_personne';
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $castingsRightJoinActors = $stmt->fetchAll();

        //-----------------END SQL CRA-----------------------------------

        //----------------------------SQL PART--------------------------------
 
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM casting 
                    RIGHT JOIN role ON casting.id_role = role.id_role';
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $castingsRightJoinRoles = $stmt->fetchAll();

        //--------------------------------SQL END SQL CRR--------------------------------
        $ids = [];
        $filteredCastingData = filter_var($castingData,FILTER_SANITIZE_FULL_SPECIAL_CHARS);     //Strategy to add array = checking if imputs matches the first existsting value having an 
                                                                                                //existing id for each then we allow to execute the add public function. It's an alternative version to
                                                                                                //ensure user puts always existing data 
        $castings =$this->getCastings();
        //-------------------------END SQL-------------------------------
        foreach ($castingsRightJoinFilm as $casting)                                                       
        {
            if ($casting["titre_film"] == $castingData["titre_film"])                           //We need to use special sql requests using RIGHT JOINs because when
            {                                                                                   //we have a newly created film it has NULL 
                echo"IF IF IF";                                                                 //id_film/id_acteur/_id_role associated
                $permission1 = true;
                $ids[] = $casting["id_film"];
                break;
            }
        }
        foreach ($castingsRightJoinActors as $casting)     
        {
            if ($casting["nom"] == $castingData["nom"] && $casting["prenom"] == $castingData["prenom"])
            {
                echo "HIHHH";
                $permission2 = true;
                $ids[] = $casting["id_acteur"];
                break;
            }
        }
        foreach ($castingsRightJoinRoles as $casting)     
        {
            if ($casting["nom_role"] == $castingData["nom_role"])
            {
                $permission3 = true;
                $ids[] = $casting["id_role"];
                break;
            }
        }

        if ($permission1 && $permission2 && $permission3)  //adding only when we all 3 good values
        {
            $mySQLconnection = Connect::connexion();
            $sqlQuery = 'INSERT INTO casting (id_film, id_acteur, id_role) VALUES (:id_film, :id_acteur, :id_role)';
            $stmt = $mySQLconnection->prepare($sqlQuery);
            $stmt->bindValue(':id_film',$ids[0]);    
            $stmt->bindValue(':id_acteur',$ids[1]);
            $stmt->bindValue(':id_role', $ids[2]);
            $stmt->execute();
        }

    }
    public function deleteCasting($id_film, $id_acteur, $id_role)
    {
        // deleteCastingModel($id_film, $id_acteur, $id_role);
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'DELETE FROM casting
                    WHERE id_acteur = :id_acteur
                    AND id_film = :id_film
                    AND id_role = :id_role';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':id_film',$id_film, \PDO::PARAM_INT);
        $stmt->bindValue(':id_acteur',$id_acteur, \PDO::PARAM_INT);
        $stmt->bindValue(':id_role',$id_role, \PDO::PARAM_INT);
        $stmt->execute();
    
        unset($stmt);
    }    
}
