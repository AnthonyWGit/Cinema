<?php 
// require_once ('src/models/filmsGenresModel.php');
// require_once ('src/models/genreModel.php');
// require_once ('src/models/filmModel.php'); //need this one to get correct id and list of films 

namespace Controllers;
use Models\Connect;

class FilmsGenreController
{
    function displayFilmsGenres()
    {
        $films = getFilms();
        //----------------------------------------------------------------------
                //----------SQL PART-----------------------
                $mySQLconnection = Connect::connexion();
                $sqlQuery = 'SELECT * FROM genre'; 
                $stmt = $mySQLconnection->prepare($sqlQuery);
                $stmt->execute();
                $genres = $stmt->fetchAll();
            
        //----------------------------------------------------------------
        $genresFilmsList = [];
        $filmsList = [];
        //------------Building a new array of genres for dropdown-----------------
        foreach ($genres as $genre) //This will be used for the dropdown to add director when creating new row
        {
            $genresFilmsList[$genre["id_genre"]] = [
                "nom_genre" => $genre["nom_genre"],
                "id" => $genre["id_genre"],
            ];
        }
        //-------------Building a new array for film--------------
        foreach ($films as $film) //This will be used for the dropdown to add director when creating new row
        {
            $filmsList[$film["id_film"]] = [
                "titre_film" => $film["titre_film"],
                "id" => $film["id_film"]
            ];
        }
        //--------------------------SQL PART-------------------------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery =     'SELECT *, film.id_film AS TrueFilmID FROM film LEFT JOIN genrer ON film.id_film = genrer.id_film
                        LEFT JOIN genre ON genre.id_genre = genrer.id_genre'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $filmsGenres = $stmt->fetchAll();
        //-------------------------------------------------------------------------------------
 
        require "views/templates/genresFilmsList.php";
    }

    function updateFilmGenre($id_genre,$id_film,$oldID)
    {
        $whereIsNullActivated = false;
        $oldID = filter_var($oldID,FILTER_VALIDATE_INT);
        $id_genre_f = filter_var($id_genre,FILTER_VALIDATE_INT);
        $id_film_f = filter_var($id_film,FILTER_VALIDATE_INT);
        if (!$oldID) //is oldID is false it means the previous id of the genre of the film we modify is not an id or is empty so we will 
                    //create a var we will send to model to deal with this situation 
        {
            $whereIsNullActivated = true;
        }
        //-------------------------SQL PART---------------------------------------
        $mySQLconnection = Connect::connexion();
        if (!$whereIsNullActivated)
        {
            $sqlQuery = 'UPDATE genrer SET genrer.id_genre = :id_genre
                        WHERE genrer.id_film = :id_film
                        AND genrer.id_genre = :id_genreOLD'; 
            $stmt = $mySQLconnection->prepare($sqlQuery);                        
            $stmt->bindValue(':id_genre',$id_genre);
            $stmt->bindValue(':id_film',$id_film);
            $stmt->bindValue(':id_genreOLD',$oldID);
            $stmt->execute();                                                     
        }
        else //This case means we want to add a genre to a film having none. This means it has currently no filmID and genreID entries in genrer table.
            //So we don't use update (because the relation we want doesn't exist) but INSERT INTO
        {
            $sqlQuery = 'INSERT INTO genrer (id_film, id_genre)
                        VALUES (:id_film, :id_genre)'; 
            $stmt = $mySQLconnection->prepare($sqlQuery);                        
            $stmt->bindValue(':id_film',$id_film);
            $stmt->bindValue(':id_genre',$id_genre);
            $stmt->execute();                                                           
            var_dump($stmt);
        }
        //-------------------------------END SQL--------------------------------------------

    }

    function addFilmGenreData($id_film,$id_genre)
    {
        //--------------------------------SQL------------------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'INSERT INTO genrer (id_film, id_genre)
                    VALUES (:id_film, :id_genre)'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);                        
        $stmt->bindValue(':id_film',$id_film);
        $stmt->bindValue(':id_genre',$id_genre);
        $stmt->execute();     
        //-----------------------------------END SQL---------------------------------------
    }

    function deleteFilmGenre($id_film,$id_genre)
    {
        //----------------------------------SQL PART---------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'DELETE FROM genrer
                    WHERE id_film = :id_film
                    AND id_genre = :id_genre';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':id_genre',$id_genre, \PDO::PARAM_INT);
        $stmt->bindValue(':id_film',$id_film, \PDO::PARAM_INT);
        $stmt->execute();  
        //--------------------------------------------------------------------------
    }

}
