<?php
require_once ('src/models/connexion.php');

function getgenres() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM genre'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $genres = $stmt->fetchAll();
    return $genres;
}

function updateGenreModel($filteredValue,$id)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'UPDATE genre SET nom_genre = :nom_genre
                WHERE id_genre = :id_genre';
    $stmt =  $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':nom_genre',$filteredValue);
    $stmt->bindValue(':id_genre',$id,PDO::PARAM_INT);
    $stmt->execute();
}
function addGenreModel($filteredgenreData)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'INSERT INTO genre (nom_genre) VALUES (:nom_genre)';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':nom_genre',$filteredgenreData);
    $stmt->execute();
}
function deleteGenreModel($id)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'DELETE FROM genre
                WHERE id_genre = :id_genre';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_genre',$id, PDO::PARAM_INT);
    $stmt->execute();
}