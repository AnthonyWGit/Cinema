<?php

namespace Controllers;
use Models\Connect;

class LoginController
{
    function getOneRowUser($data)
    {
        //------------------------SQL request-----------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM users WHERE username= :username'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->bindValue(':username', $data["username"]);
        $stmt->execute();                                                     //The data we retrieve are in array form
        $user = $stmt->fetchAll();
        return $user;
        unset($stmt);
    }

    function displayLogin()
    {
        require_once("views/templates/login.php");
    }

    function checkPostData($data)
    {
        $password = $this->getOneRowUser($data);
        var_dump($data);
        $passwordHashed = $password[0]["password"];
        var_dump($password);

        if (password_verify($data["password"], $passwordHashed)) 
        {
            echo "password ok";
            session_start();
        } 
        else 
        {
            echo "mdp incorrect";
        }
    }
}