<?php 

namespace Controllers;
use Models\Connect;

class FilmVisitorByRealController
{
    public function getFilms($id_real)
    {
        $id_real = $id_real["id_real"];

        //------------------SQL PART--------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = '   SELECT film.id_film, film.id_realisateur, personne.nom, film.synopsis, DATE_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS "dureeFormat", personne.prenom, film.titre_film, film.duree_film, film.dateSortie_film, film.synopsis, film.image_film, film.note_film FROM personne
                        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
                        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
                        WHERE film.id_realisateur = :id_realisateur'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);   
        $stmt->bindValue('id_realisateur', $id_real);                     //Prepare, execute, then fetch to retrieve data
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

    public function displayFilms($id_real)
    {
        $filmctrl = new FilmController;
        $filmsList = $this->getFilms($id_real);
        require("views/templates/viewerReal.php");
    }

}