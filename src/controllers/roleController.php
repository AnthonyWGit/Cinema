<?php 
require_once ('src/models/roleModel.php');

function displayRoles()
{
    $roles = getRoles();
    require "views/templates/roleListing.php";
}