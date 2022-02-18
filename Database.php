<?php

abstract class Database{

    private static $pdo;

    public static function getInstance(): PDO
    {   
        if(empty(self::$pdo)){
            $dbHost     = DATABASE_HOST;
            $dbName     = DATABASE_NAME;
            $user       = DATABASE_USER;
            $password   = DATABASE_PASSWORD;

            self::$pdo = new \PDO('mysql:host='. $dbHost .';dbname='. $dbName.';charset=UTF8', $user, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    } 
}


