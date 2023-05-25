<?php 

namespace Controllers;
use Models\Connect;

class StatsGenreController
{
    function displayStatsGenres()
    {
        //-------------------------SQL REQUEST---------------------------------------
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT COUNT(film.id_film) AS "Nombre films", genre.nom_genre FROM genre
                INNER JOIN genrer ON genre.id_genre = genrer.id_genre
                INNER JOIN film ON genrer.id_film = film.id_film
                GROUP BY genre.nom_genre
                ORDER BY COUNT(film.id_film) DESC';  
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->execute();
        $rawFilmsByGenre = $stmt->fetchAll();
        //------------------------------------------------------------------

        $filmsByGenre = [];
        require_once("views/templates/statsGenre.php");
    }
}
