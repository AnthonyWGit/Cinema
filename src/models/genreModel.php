<?php
function connexion()
{
    try {
        $mySQLconnection = new PDO(                                                     //Connecting to SQL server
            'mysql:host=127.0.0.1;dbname=cinema;charset=utf8',
            'root',
            '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $mySQLconnection;
    } catch (\Exception $e) 
    { 
        die('Erreur : ' . $e->getMessage());
    }
}

function getGenres() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM genre'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $genres = $stmt->fetchAll();
    return $genres;
}