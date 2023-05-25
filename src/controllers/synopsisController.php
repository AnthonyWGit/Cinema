<?php

namespace Controllers;
use Models\Connect;

class SynopsisController
{
    public function getFilms()
    {
        $controllerFilms = new FilmController;
        $data = $controllerFilms->getFilms();
        return $data;
    }
    public function displaySynopsis($id)
    {
        $synopsisIsEmpty = true;
        $film = $this->getFilms(); // we don't actually display all the films but we need it to get $films["synopsis"];
        (empty($film[$id]["synopsis"])) ? $synopsisIsEmpty = true : $synopsisIsEmpty = false;
        require("views/templates/editSynopsis.php");
    }

    public function editSynopsis($textSynopsis, $id)
    {
        //-----------------SQL PART---------------------------
        $mySQLconnection = Connect::connexion();
        $sql = "UPDATE film SET film.synopsis = :synopsis WHERE id_film = :id_film;";
        $stmt = $mySQLconnection->prepare($sql);
        $stmt->bindValue(':synopsis', $textSynopsis);
        $stmt->bindValue(':id_film', $id);
        $stmt->execute();
        unset($mySQLconnection);
        //-----------------------------------------------------
        header("Location:index.php?action=displayFilms");
    }    
}


