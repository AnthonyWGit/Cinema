<?php

namespace Controllers;
use Models\Connect;

class UnauthorizedControllerModal
{
    function displayUnauthorizedModal()
    {

        require_once("views/templates/unauthorizedModal.php");

    }
}