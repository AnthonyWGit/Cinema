<?php
require_once ('src/models/connexion.php');

function getRoles() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM role'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $roles = $stmt->fetchAll();
    return $roles;

    unset($stmt);
}

function updateRoleModel($filteredValue,$id)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'UPDATE role SET nom_role = :nom_role
                WHERE id_role = :id_role';
    $stmt =  $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':nom_role',$filteredValue);
    $stmt->bindValue(':id_role',$id,PDO::PARAM_INT);
    $stmt->execute();

    unset($stmt);
}
function addRoleModel($filteredRoleData)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'INSERT INTO role (nom_role) VALUES (:nom_role)';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    var_dump($filteredRoleData);
    $stmt->bindValue(':nom_role',$filteredRoleData);
    $stmt->execute();

    unset($stmt);
}
function deleteRoleModel($id)
{   //When we want to delete the role when need to break all links it has with film and acteurs tables in casting

    $mySQLconnection = connexion();
    $sqlQuery = 'DELETE FROM role
                WHERE id_role = :id_role';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_role',$id, PDO::PARAM_INT);
    $stmt->execute();


    $sqlQuery = 'DELETE FROM role
                WHERE id_role = :id_role';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(':id_role',$id, PDO::PARAM_INT);
    $stmt->execute();

    unset($stmt);
}