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

        if (isset($_SESSION["session"]))        //Checking if user is already logged in 
        {
            echo "Hm... vous êtes déjà connecté !";
        }

        else
        {

            $userData = $this->getOneRowUser($data);        //getting the hashed pass from db

            $userExistsDB = false;
            $userExistsEmail = false;
            $passwordsMatches = false;

            if (isset($userData[0]["username"]) && !empty($userData[0]["username"] && $userData[0]["username"] == $data["username"]))  //Checking if input user from form exists 
            {
                $userExistsDB = true;
            }
            else
            {
                $msg ="Cet utilisateur n'existe pas";                
                require_once("views/templates/loginEnd.php");
            }

            if (isset($userData[0]["email"]) && !empty($userData[0]["email"] && $userData[0]["email"] == $data["email"]))  //Checking if input email from form exists 
            {
                $userExistsEmail = true;
            }
            else
            {
                $msg ="Cet email n'existe pas";                
                require_once("views/templates/loginEnd.php");
            }

//Now that we verified that the username exists we verify user pwd imput and hashed pwd from db
            if (isset($userData[0]["password"]) && password_verify($data["password"], $userData[0]["password"]))  
            {
                $passwordsMatches = true;
            } 
            else 
            {
                $msg = "Le mot de passe n'est pas bon.";  //error case
                require_once("views/templates/loginEnd.php");
            }

//We log in when everything is well 
            if ($passwordsMatches)
            {
                require_once("views/templates/loginEnd.php");
                $_SESSION['userName'] = $data["username"];              //session stuff after require because in the views there is a sesssion start
                $_SESSION["session"] = true;                
            }
            else
            {
                $msg = "Erreur fatale";
                require_once("views/templates/loginEnd.php");
            }
        }
    }
}