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

function updateFilmsModel($filmData)
{
    $mySQLconnection = connexion();
    $fieldNameValues = [];

    // Iterate over each film : the first foreach loops over all the ids
    foreach ($filmData['id_film'] as $index => $id) 
    {
        $sqlQueryPart = 'SET ';        
        // Update each attribute of the current film : this loops over all the items inside the row
        foreach ($filmData as $fieldName => $value) 
        {
            $sqlQueryPart .= $fieldName. " = :". $fieldName. ", ";
            //$fieldNameValues["id_film"] = $id;
            $fieldNameValues[$fieldName] = $value[$index] ;
            // Bind the parameters
            // $statement->bindValue(':id_film', $id);
            // $statement->bindValue($fieldName, $value[$index]);
            // Execute the statement
        }
            $sqlQueryPart = rtrim($sqlQueryPart, ", ");
            echo "XXXXXXXXXXX";
            $fieldNameValues["id_film"] = $id;
            $sqlQuery =     'UPDATE film INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                            INNER JOIN personne ON realisateur.id_personne = personne.id_personne 
                              '. $sqlQueryPart .' WHERE id_film = :id_film';
            
            $statement = $mySQLconnection->prepare($sqlQuery);  
            var_dump($statement);
            echo "</br> </br> </br> </br> </br> </br> ";
            var_dump($fieldNameValues);         
            echo "XXXXXXX<br/> ";
            var_dump($statement);         
            $statement->execute($fieldNameValues);       
            $sqlQueryPart = "";     

    }
}