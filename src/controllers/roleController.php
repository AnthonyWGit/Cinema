<?php 
// require_once ('src/models/roleModel.php');

namespace Controllers;
use Models\Connect;

class RoleController
{

    public function displayRoles()
    {
        //------------------------SQL request-----------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'SELECT * FROM role'; 
        $stmt = $mySQLconnection->prepare($sqlQuery);                        //Prepare, execute, then fetch to retrieve data
        $stmt->execute();                                                     //The data we retrieve are in array form
        $roles = $stmt->fetchAll();

        unset($stmt);
        //-----------------------------------------------------------------
        require "views/templates/roleListing.php";
    }

    public function updateRole($dataRole, $id)
    {
        foreach ($dataRole as $fieldName=>$value)
        {
            $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);    //Sanitizing value in array
            $dataRole[$fieldName] = $filteredValue;                                     //replacing original values by sanitized
        }

        //---------------------SQL REQUEST------------------------------
        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'UPDATE role SET nom_role = :nom_role
                    WHERE id_role = :id_role';
        $stmt =  $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':nom_role',$filteredValue);
        $stmt->bindValue(':id_role',$id,\PDO::PARAM_INT);
        $stmt->execute();
        //--------------------------------------------------------------

        unset($stmt);
    }

    public function addRole($roleData)
    {
        $filteredRoleData = filter_var($roleData["nom_role"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //--------------------SQL REQUSET -----------------------------

        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'INSERT INTO role (nom_role) VALUES (:nom_role)';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        var_dump($filteredRoleData);
        $stmt->bindValue(':nom_role',$filteredRoleData);
        $stmt->execute();
    
        unset($stmt);

        //-------------------------------------------------------
    }
    public function deleteRole($id)
    {
        //--------------------------SQL REQUEST --------------------------------------------
        //When we want to delete the role when need to break all links it has with film and acteurs tables in casting

        $mySQLconnection = Connect::connexion();
        $sqlQuery = 'DELETE FROM casting
                    WHERE id_role= :id_role';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':id_role',$id, \PDO::PARAM_INT);
        $stmt->execute();

        $sqlQuery = 'DELETE FROM role
                    WHERE id_role = :id_role';
        $stmt = $mySQLconnection->prepare($sqlQuery);
        $stmt->bindValue(':id_role',$id, \PDO::PARAM_INT);
        $stmt->execute();

        unset($stmt);
        //---------------------------------------------------------------------------
    }  
}
