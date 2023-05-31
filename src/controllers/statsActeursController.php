<?php 
// require_once ("src/models/acteurModel.php");
// require_once ("src/models/statsActeursModel.php");

namespace Controllers;

use Models\Connect;

class StatsActeursController
{

    public function getStatsActeurs()
    {
        //---------------------------SQL REQUEST GET ALL ACTORS WHO ARE OLDER THAN 50--------------------------
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT * FROM personne
                LEFT JOIN acteur ON personne.id_personne = acteur.id_personne
                WHERE ((YEAR(CURDATE()) - YEAR(personne.dateDeNaissance )) > 50) AND acteur.id_acteur IS NOT NULL
                ';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->execute();
        $statsActeurs = $stmt->fetchAll();
        //---------------------------------------------------------------------------------   
        return $statsActeurs;     
    }
    public function getAllActors()
    {
        //---------------------------SQL REQUESTS GET ALL ACTORS-------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM acteur INNER JOIN personne ON acteur.id_personne=personne.id_personne'; //
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $allActeurs = $stmt->fetchAll();
        //--------------------------------SQL REQUEST END--------------------------------       
        foreach ($allActeurs as $acteur) //This will be used for the dropdown to add director when creating new row
        {
            $acteursList[$acteur["id_acteur"]] = [
                "name" => $acteur["nom"],
                "forename" => $acteur["prenom"],
                "id" => $acteur["id_acteur"]
            ];
        }
        return $acteursList;
    }
    public function getActorsSex()
    {
        //--------------------------------SQL REQUEST NUMBER OF ACTORS BY SEX-----------------------------------
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT COUNT(personne.sexe) AS "nombre", personne.sexe FROM acteur INNER JOIN personne ON acteur.id_personne=personne.id_personne
                WHERE ((personne.sexe LIKE "H%") OR (personne.sexe LIKE "F%")  OR (personne.sexe LIKE "A%"))
                GROUP BY personne.sexe';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->execute();
        $actorsSex = $stmt->fetchAll();
        //---------------------------------END SQL REQUEST--------------------------------------------------- 
        return $actorsSex;       
    }

        public function displayStatsActeurs()
    {

        $msg = "";
        $arrayFilmActeur = [];
        $statsActeurs = $this->getStatsActeurs();
        $acteursList = $this->getAllActors();
        $actorsSex = $this->getActorsSex();
        if (isset($_SESSION["privilege"]) && ($_SESSION["privilege"] = "admin"))
        {
            require_once("views/templates/statsActeurs.php");
        }
        else
        {
            $_SESSION["msg"] = "<li>Accès non autorisé.</li>";
            require_once "views/templates/unauthorized.php";
        }

    }
        public function displayFilmActor($id)
    {
        $statsActeurs = $this->getStatsActeurs();
        $acteursList = $this->getAllActors();
        $actorsSex = $this->getActorsSex();
        
        //--------------------SQL REQUEST6 ALL FILM FROM SELECTED ACTOR----------------------------
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT * FROM film INNER JOIN casting ON film.id_film = casting.id_film
                WHERE id_acteur = :id_acteur';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->bindValue(':id_acteur', $id,\PDO::PARAM_INT);
        $stmt->execute();
        $acteurPlayedFilm = $stmt->fetchAll();
        //---------------------------END-------------------------------------------
        $msg = "";

        foreach ($acteurPlayedFilm as $film)
        {
            $arrayFilmActeur[$film["id_film"]] = ["titre_film" => $film["titre_film"]];
        }

        if (isset($arrayFilmActeur) && !empty($arrayFilmActeur))
        {
            foreach ($arrayFilmActeur as $film)
            {
                $msg .='<li>'. $film["titre_film"] .'</li>';
            }              
        } 
        else
        {
            $msg ="La personne n'a joué dans aucun film présent dans la DB";
        }

        if (isset($_SESSION["privilege"]) && ($_SESSION["privilege"] = "admin"))
        {
            require_once("views/templates/statsActeurs.php");
        }
        else
        {
            $_SESSION["msg"] = "<li>Accès non autorisé.</li>";
            require_once "views/templates/unauthorized.php";
        }
    }

    // }    
        
}









