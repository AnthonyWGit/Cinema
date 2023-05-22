<?php
require_once("connexion.php");

function getStatsDeuxHeures()
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT film.titre_film, DATE_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS "Durée" FROM film 
            WHERE film.duree_film > 135
            ORDER BY film.duree_film DESC';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}

function getStatsCinqFiveYears()
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT film.titre_film  FROM film
            WHERE DATE_FORMAT( CURDATE() , "%Y") - CONVERT(film.dateSortie_film, CHAR) < 5';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}
