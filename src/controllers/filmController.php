<?php 

namespace Controllers;
use Models\Connect;
use Controllers\Math;

class FilmController
{
    public function getFilms()
    {
        //------------------SQL PART--------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = '   SELECT film.id_film, film.id_realisateur, personne.nom, film.synopsis, DATE_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS "dureeFormat", personne.prenom, film.titre_film, film.duree_film, film.dateSortie_film, film.synopsis, film.image_film, film.note_film FROM personne
                        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
                        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
                        ORDER BY film.id_film'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $filmsList = $stmt->fetchAll();
        unset($mySQLconnection);
        return $filmsList;
    //--------------------------------------------------------------        
    }

    public function getReals()
    {

        //-----SQL PART : need realisateurs List------------------------

        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM realisateur INNER JOIN personne ON realisateur.id_personne = personne.id_personne'; //priceF means priceFormated
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $realisateurs = $stmt->fetchAll();
        unset($mySQLconnection); //closing PDO connenction
        return $realisateurs;
        //--------------------------------------------------------------
    }

    public function getFilePath($id)
    {
        $mySQLconnection = Connect::connexion();
        $sql = 'SELECT image_film from film
                WHERE id_film = :id_film';
        $stmt = $mySQLconnection->prepare($sql);
        $stmt->bindValue('id_film',$id,\PDO::PARAM_STR);
        $stmt->execute();
        $filePath = $stmt->fetchAll();
        unset($mySQLconnection);
        return $filePath;
    }

    public function displayFilms()
    {

        $filmsList = $this->getFilms();
        $realisateurs = $this->getReals(); 

        $realisateursList = [];
        foreach ($realisateurs as $real) //This will be used for the dropdown to add director when creating new row
        {
            $realisateursList[$real["id_realisateur"]] = [
                "name" => $real["nom"],
                "forename" => $real["prenom"],
                "id" => $real["id_realisateur"]
            ];
        }
        $realisateursList = array_unique($realisateursList, SORT_REGULAR); //We don't need duplicates

        if (isset($_SESSION["privilege"]) && ($_SESSION["privilege"] = "admin"))
        {
            require("views/templates/filmListing.php");            
        }
        else
        {
            $_SESSION["msg"] = "<li>Accès non autorisé.</li>";
            require_once "views/templates/unauthorized.php";
        }
    }

    public function updateFilms($datafilm, $idZ)
    {
        $permissionInt = true;
        $permission = false;                                            //Setting a value that we will turn to true after verification
        if (isset($datafilm) && !empty(array_filter($datafilm)))        //Checking if the user put something in the form. Using array_filter
        {                                                               //because $filmData is an array
            foreach ($datafilm as $fieldName => $value)
            {                                       //Need the following switch case to the filter different dataTypes
                switch ($fieldName)
                {
                    case "dateSortie_film":
                        $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                        $datafilm[$fieldName] = $filteredValue;
                        echo("Filtered dateSortie");
                        $permission = true;
                        break;
                    
                    case "duree_film": //We need to check if user put correct form format. But DB has only films in minuts
                        $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //so we have to do conversion. Here sanitizing
                        if (preg_match("/^\d{2}:\d{2}$/", $filteredValue)) //If the pattern of the string is :"1 number, 1 number, semi column,
                            {                                                  //, one number, one number
                                $filteredValue = Math::filterFourNumbers($filteredValue);
                                $datafilm[$fieldName] = $filteredValue;
                                $permission = true;
                            }
                        else if (preg_match("/^\d{1}:\d{2}$/", $filteredValue)) 
                            {
                                $filteredValue = Math::filterThreeNumbers($filteredValue);
                                $datafilm[$fieldName] = $filteredValue;
                                $permission = true;
                            }
                        else
                        {
                                echo "String does not match pattern!";
                                $permission = false;                    
                        }
                        break;
                    
                        case "id_realisateur";                 
                        $isIdRAnInt = filter_var($value, FILTER_VALIDATE_INT);
                        if (!$isIdRAnInt) $permissionInt = false;
                        $permission =true;
                        break;

                    default:
                        $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $datafilm[$fieldName] = $filteredValue;
                        echo ("Filtered named fields");
                        $permission = true;
                        break;                 
                }
            }
        //-----END FOREACH------
            if ($permission && $permissionInt)
            {
                var_dump($fieldName);
                var_dump($idZ);
                $mySQLconnection = Connect::connexion();
                foreach ($datafilm as $fieldName => $values)
                {
                    $sqlQuery = 'UPDATE film 
                    SET '. $fieldName . ' = :'.$fieldName.' WHERE id_film = :id_film';
                    $stmt = $mySQLconnection->prepare($sqlQuery);
                    $stmt->bindValue($fieldName, $values);
                    $stmt->bindValue('id_film',$idZ,\PDO::PARAM_INT);
                    $stmt->execute();
                }
                unset($mySQLconnection);    
                header("Location:index.php?action=displayFilms");
            }
        }
        else
        {

        }
    }

    public function uploadFile($file, $id)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];  // Allowed picture types
        $maxSize = 100000000; // 100 MB in bytes                   // 100 MB max size

        // Check if file type and MIME type are allowed
        if (in_array($file["file"]["type"], $allowedTypes) && in_array(mime_content_type($file["file"]["tmp_name"]), $allowedTypes) && $file["file"]["size"] <= $maxSize) 
        {
            // Generate a unique ID for the file
            $uniqueId = uniqid('', true); // The second parameter generates a more unique ID
            // Sanitize file name and generate new file path
            $fileName = filter_var(basename($file["file"]["name"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // gives .jpg as example 
            $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME); // gives the file name without extension 
            $newFileName = $fileNameWithoutExtension . '_' . $uniqueId . '.' . $fileExtension; //Building a new file name we add _id behind the name 
            $uploadsDir = 'uploads/'; //uploads dir
            $filePath = $uploadsDir . $newFileName;
            move_uploaded_file($file["file"]["tmp_name"], $uploadsDir . basename($newFileName));   //Moving files from local to folder  
            
            //----------------------------SQL PART----------------------------------------------
            $mySQLconnection = Connect::connexion();
            $sql = "UPDATE film SET image_film = :filePath WHERE id_film = :id_film";
            $stmt = $mySQLconnection->prepare($sql);
            var_dump($stmt);
            echo "</br></br> UUP </br></br>";
            var_dump($filePath);
            echo "</br></br> UUP </br></br>";
            $stmt->bindValue(':filePath', $filePath);
            $stmt->bindValue(':id_film', $id,\PDO::PARAM_INT);
            $stmt->execute();
            unset($mySQLconnection);
            //-------------------------------------------------------------------------------------
        }
        else    //wrong type or too heavy
        {
            echo "failed";
        }
    }

    public function addFilm($filmData,$fileData)
    {

        //------------------------ File part : copy past of what's above--------------------
        $filePath ="";
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];  // Allowed picture types
        $maxSize = 100000000; // 100 MB in bytes                   // 100 MB max size

        // Check if file type and MIME type are allowed
        if (in_array($fileData["fileNew"]["type"], $allowedTypes) && in_array(mime_content_type($fileData["fileNew"]["tmp_name"]), $allowedTypes) && $fileData["fileNew"]["size"] <= $maxSize) 
        {
            // Generate a unique ID for the file
            $uniqueId = uniqid('', true); // The second parameter generates a more unique ID
            // Sanitize file name and generate new file path
            $fileName = filter_var(basename($fileData["fileNew"]["name"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // gives .jpg as example 
            $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME); // gives the file name without extension 
            $newFileName = $fileNameWithoutExtension . '_' . $uniqueId . '.' . $fileExtension; //Building a new file name we add _id behind the name 
            $uploadsDir = 'uploads/'; //uploads dir
            $filePath = $uploadsDir . $newFileName;
            move_uploaded_file($fileData["fileNew"]["tmp_name"], $uploadsDir . basename($newFileName));   //Moving files from local to folder  
        }
        //----------------------------END FILE PART-------------------------------------
        $bindValuePlus = false;
        $filmData["duree_film"] = Math::filterFourNumbers($filmData["duree_film"]);  //Converting format |For now coverage is only format 4 nb
        $fieldNameValues =[];
        $sqlFilePartInsert = "";
        $sqlFilePartValues = "";
        foreach ($filmData as $fieldName => $value)
        {
            $fieldNameValues[$fieldName] = $value ;
        }
        //-------------------------SQL PART----------------------------------        
        $mySQLconnection = Connect::connexion();
            if (!empty($filePath)) 
            {
                $sqlFilePartInsert = ", film.image_film";
                $sqlFilePartValues = ", :image_film";
                $bindValuePlus = true;
            }
        $sql = 'INSERT INTO  film (film.id_realisateur, film.titre_film, film.duree_film, film.dateSortie_film '.$sqlFilePartInsert.')
                VALUES (:id_realisateur, :titre_film, :duree_film, :dateSortie_film'.$sqlFilePartValues.' )';
        $stmt = $mySQLconnection->prepare($sql);
        if ($bindValuePlus) $fieldNameValues["image_film"] = $filePath; //Adding file if used put one 
        $stmt->execute($fieldNameValues);
        unset($mySQLconnection);
    }

    public function deleteFilm($id)
    {
        $filePath = $this->getFilePath($id);                  //We will use the filePath var to retrive filepath and if there is one
        $filePath = $filePath[0]["image_film"];                   //the model public function will have unlick so we delete the file
        $isEmptyPathfile = false;
        var_dump($filePath);
        if (empty($filePath)) $isEmptyPathfile = true;

        //-----------------SQL PART----------------------------------
        if ($isEmptyPathfile == false)            /*Deleting uploaded file under the path and id of the film is*/
                                            /*model responsability*/
        {                                                           
            unlink($filePath);
        }

        $mySQLconnection = Connect::connexion();
        $sql = 'DELETE FROM casting
        WHERE id_film = :id_film';
        $stmt = $mySQLconnection->prepare($sql);
        $stmt->bindValue(':id_film',$id,\PDO::PARAM_INT);
        $stmt->execute();

        $sql = 'DELETE FROM film
        WHERE id_film = :id_film';
        $stmt = $mySQLconnection->prepare($sql);
        $stmt->bindValue(':id_film',$id,\PDO::PARAM_INT);
        $stmt->execute();
        unset($mySQLconnection);           //Closing connexion
        //------------------------------------------------------------
    }
}
