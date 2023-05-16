<?php 

require ("src/models/filmModel.php");
require ("src/controllers/math.php");

function displayFilms()
{
    $filmsList = getFilms(); 
    $realisateursList = [];
    foreach ($filmsList as $film) //This will be used for the dropdown to add director when creating new row
    {
        $realisateursList[$film["id_realisateur"]] = [
            "name" => $film["nom"],
            "forename" => $film["prenom"],
            "id" => $film["id_realisateur"]
        ];
    }
    $realisateursList = array_unique($realisateursList, SORT_REGULAR); //We don't need duplicates
    ksort($realisateursList);
    require("views/templates/filmListing.php");
}

function updateFilms($filmData, $idZ)
{
    $permission = false;                                            //Setting a value that we will turn to true after verification
    if (isset($filmData) && !empty(array_filter($filmData)))        //Checking if the user put something in the form. Using array_filter
    {                                                               //because $filmData is an array
        foreach ($filmData as $fieldName => $value)
        {                                       //Need the following switch case to the filter different dataTypes
            switch ($fieldName)
            {
                case "dateSortie_film":
                    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    $filmData[$fieldName] = $filteredValue;
                    echo("Filtered dateSortie");
                    $permission = true;
                    break;
                
                case "duree_film": //We need to check if user put correct form format. But DB has only films in minuts
                    $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //so we have to do conversion. Here sanitizing
                    if (preg_match("/^\d{2}:\d{2}$/", $filteredValue)) //If the pattern of the string is :"1 number, 1 number, semi column,
                        {                                                  //, one number, one number
                            $filteredValue = filterFourNumbers($filteredValue);
                            $filmData[$fieldName] = $filteredValue;
                            $permission = true;
                        }
                    else if (preg_match("/^\d{1}:\d{2}$/", $filteredValue)) 
                        {
                            $filteredValue = filterThreeNumbers($filteredValue);
                            $filmData[$fieldName] = $filteredValue;
                            $permission = true;
                        }
                    else
                    {
                            echo "String does not match pattern!";
                            $permission = false;
                            var_dump($permission);                        
                    }
                    break;

                default:
                    $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $filmData[$fieldName] = $filteredValue;
                    echo ("Filtered named fields");
                    $permission = true;
                    break;                 
            }
        }
        if ($permission)
        {
            updateFilmsModel($filmData, $idZ);
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
    $filmData["duree_film"] = filterFourNumbers($filmData["duree_film"]);  //Converting format |For now coverage is only format 4 nb
    addFilmModel($filmData,$fileData);                                      //fileData contains file path
    header("Location:index.php?action=displayFilms");
}

function deleteFilm($id)
{
    deleteFilmModel($id);
    header("Location:index.php?action=displayFilms");
}