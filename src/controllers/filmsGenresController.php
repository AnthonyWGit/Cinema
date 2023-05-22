<?php 
require_once ('src/models/filmsGenresModel.php');

function displayFilmsGenres()
{
    $filmsGenres = getFilmsGenres();
    $genresFilmsList = [];
    foreach ($filmsGenres as $filmGenre) //This will be used for the dropdown to add director when creating new row
    {
        $genresFilmsList[$filmGenre["id_genre"]] = [
            "nom_genre" => $filmGenre["nom_genre"],
            "id" => $filmGenre["id_genre"]
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

