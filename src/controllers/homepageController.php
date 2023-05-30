<?php 
//require_once "src/models/homepageModel.php";

namespace Controllers;
use Models\Connect;

class HomepageController
{
    public function landingOnWebsite()
    {   //The fetLastUpdate public function is borked. It uses information.schema_tables and this doesn't count changes done via web forms and stuff

        //------------------SQL REQUEST------------------------------------
        $mySQLconnexion = Connect::connexion();
        $sqlWHEREpart = "";
        $sql = 'SELECT 
        TABLE_NAME AS TableName, 
        update_time AS LastUpdated 
        FROM 
        information_schema.tables 
        WHERE 
        table_schema = "cinema" ';
        $stmt = $mySQLconnexion->prepare($sql);
        $stmt->execute();
        $dateTime = $stmt->fetchAll();


        require("views/templates/homepage.php") ;
        //--------------------------END SQL-------------------------------------
    }
}
