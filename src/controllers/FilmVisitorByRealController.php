<?php 

namespace Controllers;
use Models\Connect;

class FilmVisitorByRealController
{
    public function getFilms($id_real)
    {
        $id_real = $id_real["id_real"];

        //------------------SQL PART--------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = '  SELECT film.id_film, film.id_realisateur, COUNT(genre.nom_genre) AS count, personne.nom,  film.titre_film, film.image_film FROM personne
                        right JOIN realisateur ON personne.id_personne = realisateur.id_personne
                        right JOIN film ON realisateur.id_realisateur = film.id_realisateur
                        left JOIN genrer ON genrer.id_film = film.id_film
                        left JOIN genre ON genre.id_genre = genrer.id_genre
                        WHERE film.id_realisateur = :id_realisateur
                        GROUP BY film.id_film'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);   
        $stmt->bindValue('id_realisateur', $id_real);                     //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $filmsList = $stmt->fetchAll();
        unset($mySQLconnection);
        return $filmsList;
    //--------------------------------------------------------------        
    }

    public function getGenres($id_real)
    {
        $gerelst = [];
        $genresctrl = new GenreController();
        $pete = $genresctrl->getGenres();
        foreach ($pete as $genre)
        {
                $gerelst[$genre["id_genre"]] =
                [
                    "nom_genre" => $genre["nom_genre"]
                ];
        }

        $filmsList = $this->getFilms($id_real);
        $dest = [];
        foreach ($filmsList as $film)
        {
            $id_film = $film["id_film"];
            $mySQLconnection = Connect::connexion();
            $sqlQuery = 'SELECT genre.nom_genre from genre INNER JOIN genrer ON genrer.id_genre = genre.id_genre  inner JOIN film ON genrer.id_film = film.id_film
            WHERE film.id_film = :id_film'; 
            $stmt = $mySQLconnection->prepare($sqlQuery);   
            $stmt->bindValue('id_film', $id_film);                     //Prepare, execute, then fetch to retrieve data
            $stmt->execute();                                                     //The data we retrieve are in array form
            $genresList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $nomGenreArray = [];
            foreach ($genresList as $genre) {
                $nomGenreArray[] = $genre["nom_genre"];
            }
            $resultArray = ["nom_genre" => $nomGenreArray];
         
            if (empty($genresList)) 
            {
                $resultArray = ["nom_genre" => ["AT"]]; 
            }

            $filmed = array_merge($film,$resultArray);


            $dest[] = $filmed;

        }

        return $dest;
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

    public function displayFilms($id_real)
    {
        $zero = false;
        $arrayFilms = [];
        $filmsList = $this->getFilms($id_real);
        $genresList = $this->getGenres($id_real);
        // $dest = $this->getGenres($id_real);
        // foreach ($dest as $film)
        // {
        //     foreach ($film as $c)
        //     {
        //         $arrayFilms[] = $c;
        //     }
        // }

        foreach ($genresList as $genre)
        {
            if ($genre["nom_genre"] == NULL) $zero = true;
        }
        require("views/templates/viewerReal.php");
    }

}