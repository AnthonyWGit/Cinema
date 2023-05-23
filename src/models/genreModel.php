<?php
require_once ('src/models/connexion.php');

function getgenres() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM genre'; 
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->execute();
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
function addGenreModel($filteredGenreData)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'INSERT INTO genre (nom_genre) VALUES (:nom_genre)';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':nom_genre',$filteredGenreData);
    $stmt->execute();
}
function deleteGenreModel($id)
{
    // We need to get rid of the entries in genrer table where there is the id of genre we want to dolete 
    $mySQLconnection = connexion();
    $sqlQuery = 'DELETE FROM genrer
                WHERE id_genre = :id_genre';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_genre',$id, PDO::PARAM_INT);
    $stmt->execute();


    $sqlQuery = 'DELETE FROM genre
                WHERE id_genre = :id_genre';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_genre',$id, PDO::PARAM_INT);
    $stmt->execute();
}