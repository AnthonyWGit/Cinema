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

function getFilms() 
{
    $mySQLconnection = connexion();
    $sqlQuery = '   SELECT film.id_film, personne.nom, personne.prenom, film.titre_film, film.duree_film, film.dateSortie_film, film.synopsis, film.image_film, film.note_film FROM personne
                    INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
                    INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
                    ORDER BY film.id_film   '; 
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $films = $stmt->fetchAll();
    return $films;
}