<?php

namespace Controllers;
use Models\Connect;

class CinemaController
{
    public function displayGenres()
    {
        //----------SQL PART-----------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM genre'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->execute();
        $genres = $stmt->fetchAll();
        $genres = getGenres();
        //-----------------------------------------

        require "views/templates/genreListing.php";
        return $genres;        
    }
    
    function addGenre($genreData)
    {
        $filteredGenreData = filter_var($genreData["nom_genre"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //---------------------SQL PART-------------------------------
        $mySQLconnection = connexion();
        $sqlQuery = 'INSERT INTO genre (nom_genre) VALUES (:nom_genre)';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':nom_genre',$filteredGenreData);
        $stmt->execute();
        //-------------------------------------------------------------
    }

    function deleteGenre($id)
    {
    //------------------------------SQL PART
           // We need to get rid of the entries in genrer table where there is the id of genre we want to dolete 
    $mySQLconnection = connexion();
    $sqlQuery = 'DELETE FROM genrer
                WHERE id_genre = :id_genre';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_genre',$id, \PDO::PARAM_INT);
    $stmt->execute();


    $sqlQuery = 'DELETE FROM genre
                WHERE id_genre = :id_genre';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_genre',$id, \PDO::PARAM_INT);
    $stmt->execute();
    //-------------------------------------------
    }
}