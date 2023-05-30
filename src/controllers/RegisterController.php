<?php

namespace Controllers;
use Models\Connect;

class RegisterController
{
    function displayPage()
    {
        require_once ("views/templates/register.php");
    }    
}
