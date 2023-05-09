<?php 

require ("../models/filmModel.php");

function displayFilms()
{
$filmsList = getFilms(); 
return $filmsList;   
}
function landingOnWebsite()
{
    header("Location:../views/templates/homepage.php");
}

