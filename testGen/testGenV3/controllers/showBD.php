<?php
// --- showBD.php

header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Origin: *");


$contenu = "";

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

    $sql = "SELECT SCHEMA_NAME FROM information_schema.schemata";
    $result = $pdo->prepare($sql);
    $result->execute();



    foreach ($result as $enr) {
        $contenu .= "$enr[0]\n";
    }
    $contenu = substr($contenu, 0, -1);

    $pdo = null;
} catch (PDOException $e) {
    $contenu = $e->getMessage();
}

echo $contenu;
