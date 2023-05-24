<?php 
require_once ('src/models/filmsGenresModel.php');
require_once ('src/models/genreModel.php');
require_once ('src/models/filmModel.php'); //need this one to get correct id and list of films 

function displayFilmsGenres()
{
    $films = getFilms();
    $genres = getgenres();
    $filmsGenres = getFilmsGenres();
    $genresFilmsList = [];
    $filmsList = [];
    //------------Building a new array of genres for dropdown-----------------
    foreach ($genres as $genre) //This will be used for the dropdown to add director when creating new row
    {
        $genresFilmsList[$genre["id_genre"]] = [
            "nom_genre" => $genre["nom_genre"],
            "id" => $genre["id_genre"],
        ];
    }

    //-------------Building a new array for film--------------
    foreach ($films as $film) //This will be used for the dropdown to add director when creating new row
    {
        $filmsList[$film["id_film"]] = [
            "titre_film" => $film["titre_film"],
            "id" => $film["id_film"]
        ];
    }
    
    require "views/templates/genresFilmsList.php";
}

function updateFilmGenre($id_genre,$id_film,$oldID)
{
    $whereIsNullActivated = false;
    $oldID = filter_var($oldID,FILTER_VALIDATE_INT);
    $id_genre_f = filter_var($id_genre,FILTER_VALIDATE_INT);
    $id_film_f = filter_var($id_film,FILTER_VALIDATE_INT);
    if (!$oldID) //is oldID is false it means the previous id of the genre of the film we modify is not an id or is empty so we will 
                //create a var we will send to model to deal with this situation 
    {
        $whereIsNullActivated = true;
    }
    updateFilmGenreModel($id_genre_f, $id_film_f,$oldID ,$whereIsNullActivated);
}

function addFilmGenreData($id_film,$id_genre)
{
    addFilmGenreModel($id_film,$id_genre);
}

function deleteFilmGenre($id_film,$id_genre)
{
    var_dump($id_film);
    var_dump($id_genre);
    deleteFilmGenreModel($id_film,$id_genre);
}
