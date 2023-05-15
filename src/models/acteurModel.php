<?php
require_once("connexion.php");

function getActeurs() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM acteur INNER JOIN personne ON acteur.id_personne=personne.id_personne'; //
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $acteurs = $stmt->fetchAll();
    unset($mySQLconnection);
    return $acteurs;
}