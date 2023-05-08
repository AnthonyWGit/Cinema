<?php
function connexion()
{
    try {
        $mySQLconnection = new PDO(                                                     //Connecting to SQL server
            'mysql:host=127.0.0.1;dbname=landing_page;charset=utf8',
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

function getFilms() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM film'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $films = $stmt->fetchAll();
    return $films;
}

function getActeurs() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM acteur INNER JOIN personne ON acteur.id_personne = personne.id_personne'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $acteurs = $stmt->fetchAll();
    return $acteurs;
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

function getRealisateurs() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM realisateur INNER JOIN personne ON realisateur.id_personne = personne.id_personne'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $realisateurs = $stmt->fetchAll();
    return $realisateurs;
}

function getRoles() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM role'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $roles = $stmt->fetchAll();
    return $roles;
}

function getCastings() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM casting'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $roles = $stmt->fetchAll();
    return $roles;
}