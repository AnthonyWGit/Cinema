<?php

namespace Controllers;
use Models\Connect;

class GenreController
{
    public function displayGenres()
    {
        //----------SQL PART-----------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM genre'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->execute();
        $genres = $stmt->fetchAll();
    
        //-----------------------------------------

        require "views/templates/genreListing.php";
        return $genres;        
    }
    
    public function addGenre($genreData)
    {
        $filteredGenreData = filter_var($genreData["nom_genre"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //---------------------SQL PART-------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'INSERT INTO genre (nom_genre) VALUES (:nom_genre)';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':nom_genre',$filteredGenreData);
        $stmt->execute();
        //-------------------------------------------------------------
    }

    public function deleteGenre($id)
    {
        //------------------------------SQL PART
            // We need to get rid of the entries in genrer table where there is the id of genre we want to dolete 
        $mySQLconnection = Connect::connexion();
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

    public function updateGenre($dataGenres, $id)
    {
        foreach ($dataGenres as $fieldName=>$value)
        {
            $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);    //Sanitizing value in array
            $dataGenre[$fieldName] = $filteredValue;                                     //replacing original values by sanitized
        }
    //--------------SQL PART------------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'UPDATE genre SET nom_genre = :nom_genre
                    WHERE id_genre = :id_genre';
        $stmt =  $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':nom_genre',$filteredValue);
        $stmt->bindValue(':id_genre',$id,\PDO::PARAM_INT);
        $stmt->execute();
    //----------------------------------------------------------
    }
}