<?php
    class Database
{

    // proprietes
    public static $bdd;

    //
    public static function connect()
    {

        try {
            self::$bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
        } catch (Exception $erreur) {
            die('ERROR connexion a la base de donnée:' . $erreur->getMessage());
        }

        return self::$bdd;
    }
}