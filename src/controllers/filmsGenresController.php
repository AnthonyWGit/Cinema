<?php 
require_once ('src/models/filmsGenresModel.php');
require_once ('src/models/genreModel.php');

function displayFilmsGenres()
{
    $filmsGenres = getFilmsGenres();
    $genresFilmsList = [];
    $filmsList = [];
    //------------Building a new array of genres for dropdown-----------------
    foreach ($filmsGenres as $filmGenre) //This will be used for the dropdown to add director when creating new row
    {
        $genresFilmsList[$filmGenre["id_genre"]] = [
            "nom_genre" => $filmGenre["nom_genre"],
            "id" => $filmGenre["id_genre"]
        ];
    }

    //-------------Building a new array for film--------------
    foreach ($filmsGenres as $film) //This will be used for the dropdown to add director when creating new row
    {
        $filmsList[$film["titre_film"]] = [
            "titre_film" => $film["titre_film"],
            "id" => $film["id_film"]
        ];
    }
    
    require "views/templates/genresFilmsList.php";
}

function updateFilmGenre($id_genre,$id_film,$oldID)
{
    $oldID = filter_var($oldID,FILTER_VALIDATE_INT);
    $id_genre_f = filter_var($id_genre,FILTER_VALIDATE_INT);
    $id_film_f = filter_var($id_film,FILTER_VALIDATE_INT);
    updateFilmGenreModel($id_genre_f, $id_film_f,$oldID);
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
