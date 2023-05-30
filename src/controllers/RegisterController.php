<?php

namespace Controllers;
use Models\Connect;

class RegisterController
{
    function displayPage()
    {
        require_once ("views/templates/register.php");
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
        $permission3 = false;  //check username DB
        $permission0 = false;  //Check email DB
        $permission1 = false;  //Check form is valid
        $permission2 = false;  //Check if pwd matches confirm pwd
        $errorMsg ="";
        $validMsg= "";
        $pwd ="";
        $listEmails = $this->getEmails();
        $listUsername = $this->getUserNames();

        if (empty($listEmails))
        {
            $permission0 = true;
        }

        if (empty($listUsername))
        {
            $permission3 = true;
        }

        
        echo "</br></br></br></br>";
        foreach ($listEmails as $email)
        {
            if ($email["email"] == $data["email"])
            {
                $errMsg = "Cet email est déjà utilisé";
            }
            else
            {
                $permission0 = true;
                $validMsg = "L'email est libre";
            }
        }

        //_________________________________FORM-CHECK______________________________________________
        foreach($data as $field=>$fieldValue)
        {
            var_dump($fieldValue);
            switch ($field)
            {
                case "name":
                case "forename":
                case "username":
                    if (strlen($fieldValue) > 3 && !preg_match('/[^a-zA-Z0-9]/', $fieldValue && isset($fieldValue)))
                    {
                        $permission = true;
                        $validMsg = " Pseudo/nom/prénom OK";
                    }
                    else
                    {
                        $errorMsg .= "Nom/Prénom/Pseudo plus que 3 lettres svp";                        
                    }
                break;

                case "password": //must have at least one uppercase, one lowercase, one special char, must be set, at least 8 chars
                    //long, must have a numerical
                    if (strlen($fieldValue) >= 8 && preg_match('/[A-Z]/', $fieldValue) && preg_match('/[a-z]/', $fieldValue) 
                    && preg_match('/[0-9]/', $fieldValue) && preg_match('/[^a-zA-Z0-9]/', $fieldValue) && isset($fieldValue))
                    {
                        $permission1 = true;
                        $pwd = $fieldValue; //stocking password in value
                    }
                    else 
                    {
                        $errorMsg .=    "<p>La sécurité du MdP est trop faible.
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
                            $errorMsg .= "<p>Les mots de passes ne sont pas identiques</p>";
                        }
                    break;
            }
        }

        if ($permission1 && $permission2)
        {
            echo "Formulaire bien rempli";
        }
        else
        {
            echo $errorMsg;
        }
        //_____________________EMAIL CHECK________________________________
        foreach ($listEmails as $email)
        {
            if ($email["email"] == $data["email"])
            {
                $errMsg = "Cet email est déjà utilisé";
            }
            else
            {
                $permission0 = true;
                $validMsg = "L'email est libre";
            }
        }
        //_________________________Username Check________________________________

        foreach ($listUsername as $username)
        {
            if ($username["username"] == $data["username"])
            {
                $errMsg = "Ce nom d'utilisateur est déjà utilisé";
            }
            else
            {
                $permission3 = true;
                $validMsg = "Le nom d'utilisateur est libre";
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

        if ($permission0 && $permission1 && $permission2 && $permission3)
        {
            $this->registerDB($data);
            echo "Registered";
        }
    }
}
