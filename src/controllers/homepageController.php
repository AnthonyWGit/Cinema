<?php 
require_once "src/models/homepageModel.php";

function landingOnWebsite()
{   //The fetLastUpdate function is borked. It uses information.schema_tables and this doesn't count changes done via web forms and stuff
    $lastUpdatedItems = getLastUpdate();
    require("views/templates/homepage.php") ;
}

