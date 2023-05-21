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
