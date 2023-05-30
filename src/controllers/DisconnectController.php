<?php

namespace Controllers;
use Models\Connect;

class DisconnectController
{
    function Disconnect()
    {
        require_once("views/templates/disconnect.php");
        session_unset();
        session_destroy();        
    }
}