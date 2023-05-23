<?php
require_once("connexion.php");

function getStatsActeurs()
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT * FROM personne
            LEFT JOIN acteur ON personne.id_personne = acteur.id_personne
            WHERE ((YEAR(CURDATE()) - YEAR(personne.dateDeNaissance )) > 50) AND acteur.id_acteur IS NOT NULL
            ';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}

function getStatsFilmActor($id)
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT * FROM film INNER JOIN casting ON film.id_film = casting.id_film
            WHERE id_acteur = :id_acteur';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->bindValue(':id_acteur', $id);
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}
