<?php 

require ("src/models/filmModel.php");
require ("src/models/realisateurModel.php");        //Need to retrieve list of reals 
require ("src/controllers/math.php");

function displayFilms()
{
    $filmsList = getFilms();
    $realisateurs = getRealisateurs(); 
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
    require("views/templates/filmListing.php");
}

function updateFilms($DataFilm, $idZ)
{
    $permissionInt = true;
    $permission = false;                                            //Setting a value that we will turn to true after verification
    if (isset($DataFilm) && !empty(array_filter($DataFilm)))        //Checking if the user put something in the form. Using array_filter
    {                                                               //because $filmData is an array
        foreach ($DataFilm as $fieldName => $value)
        {                                       //Need the following switch case to the filter different dataTypes
            switch ($fieldName)
            {
                case "dateSortie_film":
                    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    $DataFilm[$fieldName] = $filteredValue;
                    echo("Filtered dateSortie");
                    $permission = true;
                    break;
                
                case "duree_film": //We need to check if user put correct form format. But DB has only films in minuts
                    $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //so we have to do conversion. Here sanitizing
                    if (preg_match("/^\d{2}:\d{2}$/", $filteredValue)) //If the pattern of the string is :"1 number, 1 number, semi column,
                        {                                                  //, one number, one number
                            $filteredValue = filterFourNumbers($filteredValue);
                            $DataFilm[$fieldName] = $filteredValue;
                            $permission = true;
                        }
                    else if (preg_match("/^\d{1}:\d{2}$/", $filteredValue)) 
                        {
                            $filteredValue = filterThreeNumbers($filteredValue);
                            $DataFilm[$fieldName] = $filteredValue;
                            $permission = true;
                        }
                    else
                    {
                            echo "String does not match pattern!";
                            $permission = false;
                            var_dump($permission);                        
                    }
                    break;
                
                    case "id_realisateur";
                    $isIdRAnInt = filter_var($fieldName["id"], FILTER_VALIDATE_INT);
                    if (!$isIdRAnInt) $permissionInt = false;
                    break;

                default:
                    $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $DataFilm[$fieldName] = $filteredValue;
                    echo ("Filtered named fields");
                    $permission = true;
                    break;                 
            }
        }
        if ($permission && $permissionInt)
        {
            updateFilmsModel($DataFilm, $idZ);
            header("Location:index.php?action=displayFilms");
        }
    }
    else
    {

    }
}

function uploadFile($file, $id)
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
        uploadFileModel($filePath, $id);
    }
    else    //wrong type or too heavy
    {
        echo "failed";
    }
}

function addFilm($filmData,$fileData)
{
    var_dump($fileData);
    var_dump($filmData);
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
    $filmData["duree_film"] = filterFourNumbers($filmData["duree_film"]);  //Converting format |For now coverage is only format 4 nb
    addFilmModel($filmData,$filePath);                                      //fileData contains file path
}

function deleteFilm($id)
{
    $filePath = getFiles($id);                  //We will use the filePath var to retrive filepath and if there is one
    $filePath = $filePath[0];                   //the model function will have unlick so we delete the file
    $isEmptyPathfile = false;
    if (empty($filePath)) $isEmptyPathfile = true;
    var_dump($filePath);
    deleteFilmModel($id,$isEmptyPathfile,$filePath);
}