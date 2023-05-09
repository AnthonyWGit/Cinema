<?php 

require "../models/filmModel.php";

$_GET["films"] = getFilms();

var_dump($_GET["films"]);