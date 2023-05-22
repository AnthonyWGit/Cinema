<?php
require_once ('src/models/connexion.php');

function getFilmsGenres() 
{
    $mySQLconnection = connexion();
    $sqlQuery =     ' SELECT * FROM film INNER JOIN genrer ON film.id_film = genrer.id_film
                    INNER JOIN genre ON genre.id_genre = genrer.id_genre'; 
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $filmsGenres = $stmt->fetchAll();
    return $filmsGenres;
}

function updateFilmGenreModel($id_genre, $id_film,$oldID) 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'UPDATE genrer SET genrer.id_genre = :id_genre
                WHERE genrer.id_film = :id_film
                AND genrer.id_genre = :id_genreOLD'; 
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->bindValue(':id_genre',$id_genre);
    $stmt->bindValue(':id_film',$id_film);
    $stmt->bindValue(':id_genreOLD',$oldID);
    $stmt->execute();                                                     //The data we retrieve are in array form
}

function addFilmGenreModel($id_film, $id_genre) 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'INSERT INTO genrer (id_film, id_genre)
                VALUES (:id_film, :id_genre)'; 
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->bindValue(':id_film',$id_film);
    $stmt->bindValue(':id_genre',$id_genre);
    $stmt->execute();                                                     //The data we retrieve are in array form
}

function deleteFilmGenreModel($id_film, $id_genre)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'DELETE FROM genrer
                WHERE id_film = :id_film
                AND id_genre = :id_genre';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_genre',$id_genre, PDO::PARAM_INT);
    $stmt->bindValue(':id_film',$id_film, PDO::PARAM_INT);
    $stmt->execute();
}