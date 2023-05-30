<?php

namespace Controllers;
use Models\Connect;

class RegisterController
{
    function displayPage()
    {
        require_once ("views/templates/register.php");
    }

    function displaySuccess()
    {
        require_once("views/templates/registerEnd.php");
    }
    function getUserNames()
    {
        //----------SQL PART-----------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT username FROM users'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->execute();
        $users = $stmt->fetchAll();
    
        //-----------------------------------------
        unset($mySQLconnection);
        return $users;  
    }

    function getEmails()
    {
        //----------SQL PART-----------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT email FROM users'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->execute();
        $emails = $stmt->fetchAll();
        //-----------------------------------------
        unset($mySQLconnection);
        return $emails;  
    }

    function registerDB($data)
    {
        //----------SQL PART-----------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'INSERT INTO users (NAME, forename, email, username, password) 
                    VALUES (:name, :forename, :email, :username, :password)'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->execute($data);
        unset($mySQLconnection);
        //-----------------------------------------
    }
    
    function checkPostData($data)
    {
        $permission0 = false;  //Check email DB
        $permissionName = false;  //Check if name is valid
        $permissionForename = false;  //Check if forename is valid
        $permissionUsername = false; //check if username is ok
        $permissionPwd = false; 
        $permission2 = false;  //Check if pwd matches confirm pwd
        $permission3 = false;  //check username DB        
        $_SESSION["msg"] ="";
        $pwd ="";
        $listEmails = $this->getEmails();
        $listUsername = $this->getUserNames();

        foreach ($data as $fielname=>$value)
        {
            if (empty($value))
            {
                $_SESSION["msg"] = "Vous ne pouvez pas evoyer un formulaire avec un ou des champs vides";
            }
        }

        //Case when the db is empty and we want to avoid displaying errors
        if (empty($listEmails))
        {
            $permission0 = true;
            echo "XXXXXXXX";
        }

        if (empty($listUsername))
        {
            $permission3 = true;
            echo "YYYYYYYYY";
        }

        //_________________________________FORM-CHECK______________________________________________
        foreach($data as $field=>$fieldValue)
        {
            switch ($field)
            {
                case "name":
                    if (!preg_match('/[^a-zA-Z0-9]/', $fieldValue && isset($fieldValue)))
                    {
                        $permissionName = true;
                    }
                    else
                    {
                        $permissionName = false;
                        $_SESSION["msg"] .= "<li>Pas de caractères spéciaux dans le nom</li>";
                    }
                break;
                case "forename":
                    if (!preg_match('/[^a-zA-Z0-9]/', $fieldValue && isset($fieldValue)))
                    {
                        $permissionForename = true;
                        $_SESSION["msg"] .= "<li>Pas de caractères spéciaux dans le prénom nom</li>";
                    }
                    else
                    {
                        $permissionForename = false;
                    }
                break;
                case "username":
                    if (strlen($fieldValue) > 3 && !preg_match('/[^a-zA-Z0-9]/', $fieldValue && isset($fieldValue)))
                    {
                        $permissionUsername = true;
                        $_SESSION["msg"] .= " username OK";
                    }
                    else
                    {
                        $_SESSION["msg"] .= "Pseudo de plus de 3 lettres requis. Pas de caractères spéciaux";                    
                    }
                break;

                case "password": //must have at least one uppercase, one lowercase, one special char, must be set, at least 8 chars
                    //long, must have a numerical
                    if (strlen($fieldValue) >= 8 && preg_match('/[A-Z]/', $fieldValue) && preg_match('/[a-z]/', $fieldValue) 
                    && preg_match('/[0-9]/', $fieldValue) && preg_match('/[^a-zA-Z0-9]/', $fieldValue) && isset($fieldValue))
                    {
                        $permissionPwd = true;
                        $pwd = $fieldValue; //stocking password in value
                    }
                    else 
                    {
                        $_SESSION["msg"] .=     "<p>La sécurité du MdP est trop faible.
                                        Prenez un mot de passe contenant :</p> 
                                        <ul>
                                            <li>Une lettre majuscule</li>
                                            <li>Une lettre minuscule</li>
                                            <li>Un caractère spécial</li>
                                            <li>Un chiffre</li>
                                        </ul>
                                        <p>Le mot de passe doit faire au moins 8 charactères</p>"
                                        ;
                    }
                    break;

                    case "password-confirm": //must be identical as password
                        if (isset($fieldValue) && $fieldValue == $pwd)
                        {
                            $permission2 = true;
                        }
                        else 
                        {
                            $_SESSION["msg"] .= "<p>Les mots de passes ne sont pas identiques</p>";
                        }
                    break;
            }
        }

        //_____________________EMAIL CHECK________________________________
        foreach ($listEmails as $email)
        {

            if ($email["email"] == $data["email"])
            {
                $_SESSION["msg"] = "Cet email est déjà utilisé";            //At this point it means that at least on field is incorrect
                $permission0 = false;                           //The previous value in the array could be good so when we land 
                break;                                          //on used emails we go out of loop and permission is still false
            }
            else
            {
                $permission0 = true;
                $_SESSION["msg"] = "L'email est libre";
            }
        }
        //_________________________Username Check________________________________

        foreach ($listUsername as $username)
        {

            if ($username["username"] == $data["username"])
            {
                $_SESSION["msg"] = "Ce nom d'utilisateur est déjà utilisé";
                $permission3 = false;
                break;
            }
            else
            {
                $permission3 = true;
                $_SESSION["msg"] = "Le nom d'utilisateur est libre";
            }
        }

        //______________________IF EVERYTHING OK Hash pwd_________________________________

        $options = [
            'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads' => PASSWORD_ARGON2_DEFAULT_THREADS,
        ];

        $hashedPwd = password_hash($data["password"], PASSWORD_ARGON2ID, $options);

        //___________________Preparing $data for sql insert : trim non used arrays_______________
        $data["password"] = $hashedPwd;
        unset($data["password-confirm"]);

        //____________________IF EVERYTHING OK SQL INSERT INTO USER DB___________________

        if ($permission0 == true && $permissionName == true && $permissionForename == true &&
            $permissionUsername == true && $permissionPwd == true && $permission2 == true && $permission3 == true)

        {
            $this->registerDB($data);
            $_SESSION["msg"] = "Vous êtes inscrit";
            header ("Location:index.php?action=registerOK");
        }
        else
        {
            header("Location:index.php?action=unauthorized");
        }
    }
}
