<?php
require_once ('src/models/connexion.php');

function getCastings() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM casting 
                INNER JOIN film ON casting.id_film = film.id_film
                INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
                INNER JOIN role ON casting.id_role = role.id_role
                INNER JOIN personne ON acteur.id_personne = personne.id_personne'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $castings = $stmt->fetchAll();
    return $castings;
}

function updateCastingModel($filteredValue,$id,$fieldName,$champ_casting)
{
    $mySQLconnection = connexion();             //there is no id_casting so to target a specific row we will point at the old value at :cahmp_casting
    var_dump($fieldName);
    var_dump($filteredValue);
    $sqlQuery = 'UPDATE casting 
                INNER JOIN film ON casting.id_film = film.id_film
                INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
                INNER JOIN role ON casting.id_role = role.id_role
                INNER JOIN personne ON acteur.id_personne = personne.id_personne 
                SET '.$fieldName.' = :placeholder
                WHERE '.$fieldName.' = :champ_casting';
    $stmt =  $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':placeholder',$filteredValue);
    $stmt->bindValue(':champ_casting',$champ_casting);
    var_dump($stmt);
    $stmt->execute();
}

// function addCastingModel($filteredcastingData)
// {
//     $mySQLconnection = connexion();
//     $sqlQuery = 'INSERT INTO casting (nom_casting) VALUES (:nom_casting)';
//     $stmt = $mySQLconnection->prepare($sqlQuery);
//     $stmt->bindValue(':nom_casting',$filteredcastingData);
//     $stmt->execute();
// }
// function deletecastingModel($id)
// {
//     $mySQLconnection = connexion();
//     $sqlQuery = 'DELETE FROM casting
//                 WHERE id_casting = :id_casting';
//     $stmt = $mySQLconnection->prepare($sqlQuery);
//     $stmt->bindValue(':id_casting',$id, PDO::PARAM_INT);
//     $stmt->execute();
// }