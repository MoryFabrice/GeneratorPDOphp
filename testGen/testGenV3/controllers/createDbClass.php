<?php
// --- createDbClass.php

header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Origin: *");

$tProprietes = parse_ini_file("DB.ini");

$host = $tProprietes["serveur"];
$dbName = filter_input(INPUT_POST, "dbName");
$user = $tProprietes["ut"];
$mdp = $tProprietes["mdp"];
$pathDossier = "../dossierClassMetier";

function createDbClass($host, $dbName, $user, $mdp, $pathDossier)
{
    $fichierDbClass = "<?php
    class Database
{

    // proprietes
    public static \$bdd;

    //
    public static function connect()
    {

        try {
            self::\$bdd = new PDO('mysql:host=$host;dbname=$dbName;charset=utf8', '$user', '$mdp');
        } catch (Exception \$erreur) {
            die('ERROR connexion a la base de donnée:' . \$erreur->getMessage());
        }

        return self::\$bdd;
    }
}";
    file_put_contents($pathDossier . "/Database.php", $fichierDbClass);
    return (file_exists($pathDossier . "/Database.php"));
}

createDbClass($host, $dbName, $user, $mdp, $pathDossier);

echo file_exists($pathDossier . "/Database.php");
