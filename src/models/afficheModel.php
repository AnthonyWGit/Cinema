<?php
require_once("connexion.php");

function getPathfile($id) 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT image_film FROM film
    WHERE id_film = :id_film'; //
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->bindValue(':id_film',$id);
    $stmt->execute();                                                     //The data we retrieve are in array form
    $pathFile = $stmt->fetchAll();
    unset($mySQLconnection);
    return $pathFile;
}

function getSynopsis($id)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT synopsis FROM film
    WHERE id_film = :id_film'; //
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->bindValue(':id_film',$id);
    $stmt->execute();                                                     //The data we retrieve are in array form
    $synopsis = $stmt->fetchAll();
    unset($mySQLconnection);
    return $synopsis;
}

function getOneFilmData($id)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM film
                INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
                INNER JOIN personne on realisateur.id_personne = personne.id_personne
                WHERE id_film = :id_film'; //
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->bindValue(':id_film',$id);
    $stmt->execute();                                                     //The data we retrieve are in array form
    $filmData = $stmt->fetchAll();
    unset($mySQLconnection);
    return $filmData;
}

function getOneFilmCasting($id)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM film
                INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
                INNER JOIN personne on realisateur.id_personne = personne.id_personne
                WHERE id_film = :id_film'; //
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->bindValue(':id_film',$id);
    $stmt->execute();                                                     //The data we retrieve are in array form
    $casting = $stmt->fetchAll();
    unset($mySQLconnection);
    return $casting;
}
