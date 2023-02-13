<?php


function createClassMetierType($table, $tabAttribut)
{

    $tailleTab = count($tabAttribut);
    // $tabAttribut est un tableau contenant tout les attributs de la table

    // Mise de la 1ère lettre en MAJ
    $table = ucfirst($table);

    // Initialisation du fichier de class
    $fichierClass = "<?php
class $table
{
";
    // ecrireFichier($nomFile, $fichierClass);
    // $fichierClass = "";
    // Remplissage des attributs dans le fichier grâce à une boucle
    for ($i = 0; $i < $tailleTab; $i++) {
        $fichierClass .= "  private \$$tabAttribut[$i];\n";
    }

    // ecrireFichier($nomFile, $fichierClass);
    // $fichierClass = "";

    // mise en place du constructeur
    $fichierClass .= "public function \x5F\x5Fconstruct(";
    for ($i = 0; $i < $tailleTab; $i++) {
        $fichierClass .= "\$" . $tabAttribut[$i] . ",";
    }
    $fichierClass = substr($fichierClass, 0, -1);
    $fichierClass .= ")\n{\n";


    for ($i = 0; $i < $tailleTab; $i++) {
        $fichierClass .= "  \$this->" . $tabAttribut[$i] . " = \$" . $tabAttribut[$i] . ";\n";
    }
    $fichierClass .= "}\n";


    // mise en place des getteurs et setteurs
    for ($i = 0; $i < $tailleTab; $i++) {
        $fichierClass .= "  public function get" . ucfirst($tabAttribut[$i]) . "()
    {
        return \$this->$tabAttribut[$i];
    }

    public function set" . ucfirst($tabAttribut[$i]) . "(\$$tabAttribut[$i])
    {
        \$this->$tabAttribut[$i] = \$$tabAttribut[$i];
    }\n";
    }
    $fichierClass .= "}
    ?>";

    return $fichierClass;
}
