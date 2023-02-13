<?php
include("./createZip.php");

$nomFichier = filter_input(INPUT_POST, "nomFichier");
$contenu = filter_input(INPUT_POST, "contenu");
$class = filter_input(INPUT_POST, "class");
$pathDossier = "../dossierClass";


// test exstence du dossier $pathDosier
if (file_exists($pathDossier)) {
    // test si class metier ou DAO
    if ($class === "metier") {
        // Verifier si le test est necessaire
        file_put_contents($pathDossier . "/" . $nomFichier, $contenu);
        createArchive($pathDossier . "/" . $nomFichier, $nomFichier);
        unlink($pathDossier . "/" . $nomFichier);
    } else {
        file_put_contents($pathDossier . "/" . $class . $nomFichier, $contenu);
        createArchive($pathDossier . "/" . $class . $nomFichier, $nomFichier);
        unlink($pathDossier . "/" . $class . $nomFichier);
    }
    //





    //
} else {
    mkdir($pathDossier, 0777, true);
    if ($class === "metier") {
        file_put_contents($pathDossier . "/" . $nomFichier, $contenu);
        createArchive($pathDossier . "/" . $nomFichier, $nomFichier);
        unlink($pathDossier . "/" . $nomFichier);
    } else {
        file_put_contents($pathDossier . "/" . $class . $nomFichier, $contenu);
        createArchive($pathDossier . "/" . $class . $nomFichier, $nomFichier);
    }
}


echo (file_exists('class.zip'));
