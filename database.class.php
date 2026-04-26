<?php

class Database {

    private static $dbName = 'kabylivmalik' ;
    private static $dbHost = 'kabylivmalik.mysql.db' ;
    private static $dbUsername = 'kabylivmalik';
    private static $dbUserPassword = 'Allahakbar1618';
    private static $connexion = null;
    
    public function __construct() { 
        die("Fonction d'initialisation pas permise !!!");        
    }
    
    
    public static function connect() { 
        if ( null == self::$connexion ) { 
            try { 
                self::$connexion = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
            } 
            catch(PDOException $e) { 
                die($e->getMessage()); 
            }
        } 
        return self::$connexion;
    }
    
    public static function disconnect()
    {
        self::$connexion = null;
    }
}

?>