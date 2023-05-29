<?php 

namespace Controllers;
use Models\Connect;

class FilmVisitorByGenreController
{
    public function getFilms($id_genre)
    {
        $id_genre = $id_genre["id_genre"];

        //------------------SQL PART--------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT film.id_film, film.titre_film, film.id_realisateur, film.image_film, genre.id_genre, genre.nom_genre, personne.nom, personne.prenom FROM film INNER JOIN genrer ON genrer.id_film = film.id_film 
                    INNER JOIN genre ON genrer.id_genre = genre.id_genre
                    INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                    INNER JOIN personne ON realisateur.id_personne = personne.id_personne
                    WHERE genre.id_genre = :id_genre
                    ORDER BY genre.id_genre'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);   
        $stmt->bindValue('id_genre', $id_genre);                     //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $filmsList = $stmt->fetchAll();
        unset($mySQLconnection);
        return $filmsList;
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

    public function displayFilms($id_genre)
    {
        $zero = false;
        $arrayFilms = [];
        $filmsList = $this->getFilms($id_genre);

        require("views/templates/viewerGenre.php");
    }

}