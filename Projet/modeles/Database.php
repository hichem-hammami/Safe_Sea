<?php
class Database{
    private static $connexion;
    public static function connect(){
        try{

            self::$connexion = new PDO("mysql:host=localhost;dbname=pepiniere;charset=utf8", "root", "");
        }catch(Exception $e){
            die("Connexion impossible : ".$e->getMessage());
        }
        return self::$connexion;
    }
    public static function disconnect(){
        self::$connexion = null;
    }
}