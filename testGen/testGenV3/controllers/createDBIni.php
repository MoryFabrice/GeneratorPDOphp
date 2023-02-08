<?php
// --- showBD.php

header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Origin: *");

if (file_exists("./DB.ini")) {
    unlink('DB.ini');
    createIni();
} else {
    createIni();
}

function createIni()
{
    $fichierDBIni = "";

    $host = filter_input(INPUT_POST, "host");
    $port = filter_input(INPUT_POST, "port");
    $utilisateur = filter_input(INPUT_POST, "utilisateur");
    $mdp = filter_input(INPUT_POST, "mdp");

    $fichierDBIni .= "[section_connexion]
protocole=mysql
serveur=$host
port=$port
bd=information_schema
ut=$utilisateur
mdp=$mdp";

    file_put_contents("DB.ini", $fichierDBIni);
    return $host;
}


echo (createIni());
