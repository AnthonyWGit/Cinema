<?php
require_once("connexion.php");

function getStatsReals()
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT COUNT(film.id_film) AS "Nombre films", personne.nom, personne.prenom FROM personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
            GROUP BY realisateur.id_realisateur
            ORDER BY COUNT(film.id_film) DESC';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}

function getStatsRealOne($id)
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT COUNT(film.id_film) AS "Nombre films", personne.nom, personne.prenom FROM personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
            WHERE realisateur.id_realisateur = :id_realisateur';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->bindValue('id_realisateur', $id);    
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}

function getStatsRealOneIsActor($id)
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT personne.nom, personne.prenom, personne.sexe, film.titre_film FROM personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
            WHERE realisateur.id_realisateur = :id_realisateur';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->bindValue('id_realisateur', $id);    
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}