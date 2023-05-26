<?php 

namespace Controllers;
use Models\Connect;

class FilmVisitorController
{
    public function getFilms()
    {
        //------------------SQL PART--------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = '   SELECT film.id_film, film.id_realisateur, personne.nom, film.synopsis, DATE_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS "dureeFormat", personne.prenom, film.titre_film, film.duree_film, film.dateSortie_film, film.synopsis, film.image_film, film.note_film FROM personne
                        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
                        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
                        ORDER BY film.id_film'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $filmsList = $stmt->fetchAll();
        unset($mySQLconnection);
        return $filmsList;
    //--------------------------------------------------------------        
    }

    public function getReals()
    {

        //-----SQL PART : need realisateurs List------------------------

        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM realisateur INNER JOIN personne ON realisateur.id_personne = personne.id_personne'; //priceF means priceFormated
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $realisateurs = $stmt->fetchAll();
        unset($mySQLconnection); //closing PDO connenction
        return $realisateurs;
        //--------------------------------------------------------------
    }

    public function getFilePath($id)
    {
        $mySQLconnection = Connect::connexion();
        $sql = 'SELECT image_film from film
                WHERE id_film = :id_film';
        $stmt = $mySQLconnection->prepare($sql);
        $stmt->bindValue('id_film',$id,\PDO::PARAM_STR);
        $stmt->execute();
        $filePath = $stmt->fetchAll();
        unset($mySQLconnection);
        return $filePath;
    }

    public function displayFilms()
    {
        $filmsList = $this->getFilms();
        $realisateurs = $this->getReals(); 

        $genreController = new GenreController;
        $genres = $genreController->getGenres();
        $realisateursList = [];
        foreach ($realisateurs as $real) //This will be used for the dropdown to add director when creating new row
        {
            $realisateursList[$real["id_realisateur"]] = [
                "name" => $real["nom"],
                "forename" => $real["prenom"],
                "id" => $real["id_realisateur"]
            ];
        }

        require("views/templates/viewerFilm.php");
    }

}