<?php 
// require_once ("src/models/filmModel.php");
// require_once ("src/models/statsFilmsModel.php");

namespace Controllers;
use Models\Connect;

class statsFilmsController
{
    public function getFiveYears()
    {
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT film.titre_film  FROM film
                WHERE DATE_FORMAT( CURDATE() , "%Y") - CONVERT(film.dateSortie_film, CHAR) < 5';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getTwoHours()
    {
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT film.titre_film, DATE_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS "Durée" FROM film 
                WHERE film.duree_film > 135
                ORDER BY film.duree_film DESC';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function displayStatsFilms()
    {
        $filmsFiveYears = $this->getFiveYears();
        $filmsLenght = $this->getTwoHours();
        require ("views/templates/statsFilms.php");
    }

}

