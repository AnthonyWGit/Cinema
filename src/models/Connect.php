<?php

namespace Models;

abstract class Connect
{
    const HOST = "database";
    const DB = "cinema";
    const USER = "root";
    const PASS = "pass";

        static function connexion()
    {
        try {
            return new \PDO(
                'mysql:host='. self::HOST .';dbname='. self::DB .';charset=utf8mb4',
                self::USER,
                self::PASS,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
            );
        } 
        catch (\PDOException $e) 
        { 
            return $e->getMessage();
        }
    }
}