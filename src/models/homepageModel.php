<?php

require_once "src/models/connexion.php";

function getLastUpdate()
{
    $mySQLconnexion = connexion();
    $sqlWHEREpart = "";
    $sql = 'SELECT 
    TABLE_NAME AS TableName, 
    update_time AS LastUpdated 
FROM 
    information_schema.tables 
WHERE 
    table_schema = "cinema" ';
    $stmt = $mySQLconnexion->prepare($sql);
    $stmt->execute();
    $dateTime = $stmt->fetchAll();
    return $dateTime;
}