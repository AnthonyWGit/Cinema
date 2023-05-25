<?php
// require_once ("src/models/afficheModel.php");
// require_once ("src/models/filmModel.php");

namespace Controllers;
use Models\Connect;

class AfficheController
{
    function displayAffiche($id) 
    {
        //-----------------------SQL DATA FROM FILM------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM film
                    INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
                    INNER JOIN personne on realisateur.id_personne = personne.id_personne
                    WHERE id_film = :id_film'; //
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->bindValue(':id_film',$id);
        $stmt->execute();                                                     //The data we retrieve are in array form
        $filmData = $stmt->fetchAll();
        unset($mySQLconnection);
        //--------------------------END SQL-------------------------------------

        //--------------SQL PATHFILE--------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT image_film FROM film
        WHERE id_film = :id_film'; //
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->bindValue(':id_film',$id);
        $stmt->execute();                                                     //The data we retrieve are in array form
        $pathFile = $stmt->fetchAll();                                         //getting pathfile here
        unset($mySQLconnection);

        //-------------END SQL PATHFILE---------------------------

        //------------------SQL SYNOPSIS---------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT synopsis FROM film
        WHERE id_film = :id_film'; //
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->bindValue(':id_film',$id);
        $stmt->execute();                                                     //The data we retrieve are in array form
        $synopsis = $stmt->fetchAll();
        unset($mySQLconnection);
        //---------------------------------------------------------

        //------------------SQL ONE FILM CASTING-----------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM casting 
                    INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
                    INNER JOIN personne ON personne.id_personne = acteur.id_personne
                    INNER JOIN role on casting.id_role = role.id_role
                    WHERE id_film = :id_film'; //
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->bindValue(':id_film',$id);
        $stmt->execute();                                                     //The data we retrieve are in array form
        $castings = $stmt->fetchAll();
        unset($mySQLconnection);
        //--------------------------------------------------------

        if (in_array(!empty($pathFile[0]["image_film"]),$pathFile)) $thereIsAFile = true; else $thereIsAFile = false;
        require_once("views/templates/affiche.php");
    }    
}
