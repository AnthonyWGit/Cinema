<?php 
// require_once ("src/models/realisateurModel.php");
// require_once ("src/models/statsRealsModel.php");

namespace Controllers;
use Models\Connect;

class StatsRealsController
{
    public function getReals()
    {
        //-------------------------------SQL--------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM realisateur INNER JOIN personne ON realisateur.id_personne = personne.id_personne'; //priceF means priceFormated
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $realisateurs = $stmt->fetchAll();
        //--------------------------END SQL--------------------------------------
        return $realisateurs;

    }
    public function getStatsReals()
    {
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT COUNT(film.id_film) AS "Nombre films", personne.nom, personne.prenom FROM personne
                INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
                INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
                GROUP BY realisateur.id_realisateur
                ORDER BY COUNT(film.id_film) DESC';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getStatsIsActor($id)
    {
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT personne.nom, personne.prenom, personne.sexe, film.titre_film FROM personne
                INNER JOIN acteur ON personne.id_personne = acteur.id_personne
                INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
                INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
                WHERE realisateur.id_realisateur = :id_realisateur';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->bindValue('id_realisateur', $id,\PDO::PARAM_INT);    
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getStatsNumberFilms($id)
    {
        $mySQLconnexion = Connect::connexion();
        $sql = 'SELECT COUNT(film.id_film) AS "Nombre films", personne.nom, personne.prenom FROM personne
                INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
                INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
                WHERE realisateur.id_realisateur = :id_realisateur';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->bindValue('id_realisateur', $id,\PDO::PARAM_INT);    
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function displayStatsReals()
    {
        $data = $this->getStatsReals();
        $allReals = $this->getReals();
        $realsArray=[];
        foreach ($allReals as $real) //This will be used for the dropdown to add director when creating new row
        {
            $realisateursList[$real["id_realisateur"]] = [
                "name" => $real["nom"],
                "forename" => $real["prenom"],
                "id" => $real["id_realisateur"]
            ];
        }
        $infosIsActor ="";      //Without this line there will be an error $isActor not defined
        require_once("views/templates/statsReals.php");
    }

    public function displayStatsOneReal($id)
    {
        $numberOfMovies = $this->getStatsNumberFilms($id);
        $data = $this->getStatsReals();
        $allReals = $this->getReals();
        $infosIsActor = "";
        $realsArray=[];
        foreach ($allReals as $real) //This will be used for the dropdown to select director
        {
            $realisateursList[$real["id_realisateur"]] = [
                "name" => $real["nom"],
                "forename" => $real["prenom"],
                "id" => $real["id_realisateur"]
            ];
        }
        require_once("views/templates/statsReals.php");
    }

    public function displayStatsOneRealIsActor($id)
    {
        $isActorToo = $this->getStatsIsActor($id);
        $data = $this->getStatsReals();
        $allReals = $this->getReals();
        $infosIsActor = "";
        $realsArray=[];
        foreach ($allReals as $real) //This will be used for the dropdown to select directors in DB 
        {
            $realisateursList[$real["id_realisateur"]] = [
                "name" => $real["nom"],
                "forename" => $real["prenom"],
                "id" => $real["id_realisateur"]
            ];
        }
        // !empty($isActorToo) ? $isActorToo[0]["nom"]." a joué dans au moins un de ses films." : $realisateursList[$id]["name"]. " a joué dans aucun film.";

        if (!empty($isActorToo))
        {
            $infosIsActor = $isActorToo[0]["nom"]." a joué dans au moins un de ses films.";
            foreach ($isActorToo as $titreFilm)
            {
                $infosIsActor .= "<li>". $titreFilm["titre_film"]. "</li>";
            }
        }
        else
        {
            $infosIsActor = $realisateursList[$id]["name"]. " a joué dans aucun film";
        }
        require_once("views/templates/statsReals.php");    
}

}