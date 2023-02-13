<?php


function createArchive($pathFile, $nomFichier)
{
    //  
    $zip = new ZipArchive;
    if ($zip->open('../dossierClass/class.zip', ZipArchive::CREATE) === TRUE) {
        $zip->addFile($pathFile, $nomFichier);
        $zip->close();
        echo 'ok';
    } else {
        echo 'échec';
    }
}
