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

function getCastingsRightJoinFilm() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM casting 
                RIGHT JOIN film ON casting.id_film = film.id_film'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $castingsRightJoinFilm = $stmt->fetchAll();
    return $castingsRightJoinFilm;
}

function getCastingsRightJoinActors() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM casting 
                RIGHT JOIN acteur ON casting.id_acteur = acteur.id_acteur
                INNER JOIN personne ON acteur.id_personne = personne.id_personne';
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $castingsRightJoinActors = $stmt->fetchAll();
    return $castingsRightJoinActors;
}

function getCastingsRightJoinRoles() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM casting 
                RIGHT JOIN role ON casting.id_role = role.id_role';
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $castingsRightJoinRoles = $stmt->fetchAll();
    return $castingsRightJoinRoles;
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

    unset($stmt);
}

function addCastingModel($ids)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'INSERT INTO casting (id_film, id_acteur, id_role) VALUES (:id_film, :id_acteur, :id_role)';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_film',$ids[0]);    
    $stmt->bindValue(':id_acteur',$ids[1]);
    $stmt->bindValue(':id_role', $ids[2]);
    $stmt->execute();
}
function deleteCastingModel($id_film, $id_acteur, $id_role)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'DELETE FROM casting
                WHERE id_acteur = :id_acteur
                AND id_film = :id_film
                AND id_role = :id_role';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_film',$id_film, PDO::PARAM_INT);
    $stmt->bindValue(':id_acteur',$id_acteur, PDO::PARAM_INT);
    $stmt->bindValue(':id_role',$id_role, PDO::PARAM_INT);
    $stmt->execute();

    unset($stmt);
}