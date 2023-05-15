<?php
require_once("connexion.php");

function getActeurs() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM acteur INNER JOIN personne ON acteur.id_personne=personne.id_personne'; //
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $acteurs = $stmt->fetchAll();
    unset($mySQLconnection);
    return $acteurs;
}

function updateActeurModel($dataActeurs,$id)
{
    {
        $mySQLconnection = connexion();
        foreach ($dataActeurs as $fieldName => $values)
        {
            $sqlQuery = 'UPDATE acteur INNER JOIN personne ON acteur.id_personne=personne.id_personne 
                        SET '. $fieldName . ' = :'.$fieldName.' WHERE id_acteur = :id_acteur';
            $stmt = $mySQLconnection->prepare($sqlQuery);
            $stmt->bindValue($fieldName, $values);
            $stmt->bindValue('id_acteur',$id);
            var_dump($stmt);
            $stmt->execute();
            unset($mySQLconnection);
        }   
    } 
}