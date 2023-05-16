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

function updateActeurModel($filteredDataActeurs,$id,$fieldName)
{
    $mySQLconnection = connexion();
    $sqlQuery = 'UPDATE acteur INNER JOIN personne ON acteur.id_personne=personne.id_personne 
                SET '. $fieldName . ' = :'.$fieldName.' WHERE id_acteur = :id_acteur';
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue($fieldName, $filteredDataActeurs);
    $stmt->bindValue('id_acteur',$id);
    var_dump($stmt);
    $stmt->execute();
    unset($mySQLconnection);
}

function addActeurModel($acteurData) //This need to add an entry in personne table and bind the id of the new person
{                                   //to the id of the new actor
    $nom = "";
    $mySQLconnection = connexion();
    $sqlQuery = "INSERT INTO personne (personne.nom, personne.prenom, personne.dateDeNaissance, personne.sexe)
                VALUES (:nom, :prenom, :dateDeNaissance, :sexe)";
    $fieldNameValues = [];
    foreach ($acteurData as $fieldName=>$value)
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
    $sqlQuery = "INSERT INTO acteur (acteur.id_personne)
                SELECT personne.id_personne FROM personne WHERE personne.nom = :nom";
    $stmt = $mySQLconnection->prepare($sqlQuery);
    $stmt->bindValue(":nom",$nom);
    $stmt->execute();                           //and here is where we create a new id actor associated with the id person 
}
