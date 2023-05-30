<?php

namespace Controllers;
use Models\Connect;

class UnauthorizedController
{
    function displayUnauthorized()
    {
        require_once("views/templates/unauthorized.php");

    }
}