<?php
require_once "src/models/connexion.php";

function getRealisateurs() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM realisateur INNER JOIN personne ON realisateur.id_personne = personne.id_personne'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $realisateurs = $stmt->fetchAll();
    return $realisateurs;
}