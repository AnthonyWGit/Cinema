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

    // Iterate over each film : the first foreach loops over all the ids
    foreach ($filmData['id_film'] as $index => $id) 
    {
        
        // Update each attribute of the current film : this loops over all the items inside the row
        foreach ($filmData as $fieldName => $value) 
        {
            $sqlQuery =     'UPDATE film INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                            INNER JOIN personne ON realisateur.id_personne = personne.id_personne 
                            SET ' . $fieldName . ' = :' . $fieldName . ' WHERE id_film = :id_film';
            $statement = $mySQLconnection->prepare($sqlQuery);

            // Bind the parameters
            $statement->bindValue(':id_film', $id);
            $statement->bindValue($fieldName, $value[$index]);
            // Execute the statement
            var_dump($statement);
            $statement->execute();
        }
    }
}

    /*$sqlQuerySetPart = "SET ";
    $fieldsNameValue = [];
    foreach ($_POST as $fieldName => $value)              //looping over all field values
    {
        if (!empty($value)) //id is a field in hidden form
        {
            $filteredValue = null;

            switch ($fieldName)
            {
                case "price":
                    $value = str_replace("," , "." , $value);
                    $filteredValue = filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);   //filtering data. F commas :-)
                    echo "VIRGULE"; 
                    var_dump($filteredValue);
                break;

                case "id_pricing":
                case "sale":
                    $filteredValue = filter_input(INPUT_POST, $fieldName, FILTER_VALIDATE_INT);   //filtering data using input because we can use it raw
                break;

                default:
                    $filteredValue = filter_input(INPUT_POST, $fieldName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);   //filtering data
                break;
            }
            
            $fieldsNameValue[$fieldName] = $filteredValue;
            // $sqlQuerySetPart .= $fieldName . " = " . $filteredValue . ", ";
            $sqlQuerySetPart .= $fieldName . " = :" . $fieldName . ", ";
            echo "CHECK >> <br />>";
            var_dump($fieldsNameValue);
            $fieldsNameValue["id_pricing"] = $_GET["id"];
        
            $sqlQuerySetPart = rtrim($sqlQuerySetPart, ", ");
        
            $sqlQuery = 'UPDATE pricing '. $sqlQuerySetPart
                        . ' WHERE id_pricing = :id_pricing';
            var_dump($sqlQuery);
            var_dump($_GET);
            $mySQLconnection = connexion();
            $persoLieuStatement = $mySQLconnection->prepare($sqlQuery);
            $persoLieuStatement->execute($fieldsNameValue); //This basically does the same thing as bindValue but on multiple ones but 
                                                            //we can't specify datatype : int by default 
        }
    }*/
