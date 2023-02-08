<?php
// --- showBD.php
include("./createClassMetier.php");
include("./createClassDAO.php");

header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Origin: *");

$attribut = "";
$resultFichier = "";

$bdd = filter_input(INPUT_POST, "listeBD");
$table = filter_input(INPUT_POST, "listeTable");
$class = filter_input(INPUT_POST, "class");

try {
    // Connexion
    // Récupération du contenu du fichier DB.ini dans un tableau associatif
    $tProprietes = parse_ini_file("DB.ini");

    // Récupération une à une des valeurs des clés du tableau associatif
    $host = $tProprietes["serveur"];
    $port = $tProprietes["port"];
    $db = $tProprietes["bd"];
    $user = $tProprietes["ut"];
    $pwd = $tProprietes["mdp"];

    // Utilisation des variables dans le DSN et les autres paramètres
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;", $user, $pwd);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'UTF8'");

    $sql = "SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA=? AND TABLE_NAME=?";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, $bdd);
    $result->bindValue(2, $table);
    $result->execute();

    foreach ($result as $enr) {
        $attribut .= "$enr[0]-";
    }
    $attribut = substr($attribut, 0, -1);

    $tabAttribut = explode("-", $attribut);

    $pdo = null;
} catch (PDOException $e) {
    $attribut = $e->getMessage();
}

if ($class === "metier") {
    $resultFichier = createClassMetierType($table, $tabAttribut);
} else {
    $resultFichier = createClassDAOType($table, $tabAttribut);
}


echo ($resultFichier);
