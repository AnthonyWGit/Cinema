<?php
require_once "src/models/connexion.php";

function getRealisateurs() 
{
    $mySQLconnection = connexion();
    $sqlQuery = 'SELECT * FROM realisateur INNER JOIN personne ON realisateur.id_personne = personne.id_personne'; //priceF means priceFormated
    $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
    $stmt->execute();                                                     //The data we retrieve are in array form
    $realisateurs = $stmt->fetchAll();
    return $realisateurs;
}

function updateRealModel($filteredDataReals,$id,$fieldName)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'UPDATE realisateur INNER JOIN personne ON realisateur.id_personne=personne.id_personne 
                SET '. $fieldName . ' = :'.$fieldName.' WHERE id_realisateur = :id_realisateur';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue($fieldName, $filteredDataReals);
    $stmt->bindValue('id_realisateur',$id,PDO::PARAM_INT);
    var_dump($stmt);
    $stmt->execute();
    unset($mySQLconnection);
}

function addRealModel($realData) //This need to add an entry in personne table and bind the id of the new person
{                                   //to the id of the new actor
    $nom = "";
    $mySQLconnection = connexion();
    $sqlQuery = "INSERT INTO personne (personne.nom, personne.prenom, personne.dateDeNaissance, personne.sexe)
                VALUES (:nom, :prenom, :dateDeNaissance, :sexe)";
    $fieldNameValues = [];
    foreach ($realData as $fieldName=>$value)
    {
        $fieldNameValues[$fieldName] = $value;
        if ($fieldName == "nom")
        $nom = $value;
    }
    $stmt = $mySQLconnection->prepare($sqlQuery);
    var_dump($sqlQuery);
    var_dump($fieldNameValues);
    echo '--------';
    var_dump($nom);
    $stmt->execute($fieldNameValues);           //Here the entry in personne is created 
    $sqlQuery = "INSERT INTO realisateur (realisateur.id_personne)
                SELECT personne.id_personne FROM personne WHERE personne.nom = :nom";
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(":nom",$nom);
    $stmt->execute();                           //and here is where we create a new id actor associated with the id person 
}
