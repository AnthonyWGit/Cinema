<?php
require_once("connexion.php");

function getStatsGenres()
{
    $mySQLconnexion = connexion();
    $sql = 'SELECT personne.nom, personne.prenom, personne.sexe, film.titre_film FROM personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
            WHERE realisateur.id_realisateur = :id_realisateur';
    $stmt = $mySQLconnexion->prepare($sql);  
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}