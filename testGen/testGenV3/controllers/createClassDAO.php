<?php

function createClassDAOType($table, $tabAttribut)
{
    // Permet de connaitre le nombre d'attribut
    // $tabAttribut est un tableau contenant tout les attributs de la table
    $tailleTab = count($tabAttribut);

    // Mise de la 1ère lettre en MAJ
    $tableMaj = ucfirst($table);

    // Initialisation du fichier de class
    $fichierClass = "<?php\n
class $tableMaj" . "DAO
{
    public function selectAll()
    {
        \$query = Database::connect()->prepare('SELECT * FROM $table');
        \$query->execute();
        \$$table" . "s = \$query->fetchAll(PDO::FETCH_ASSOC);
        return \$$table" . "s;
    }
    
    public function selectOne(\$id)
    {
        \$query = Database::connect()->prepare('SELECT * FROM $table WHERE " . $tabAttribut[0] . "= ?');
        \$query->execute([\$id]);
        \$$table = \$query->fetch(PDO::FETCH_ASSOC);
        return \$$table;
    }
    
    public function delete(\$" . $tabAttribut[0] . ")
    {
        \$query = Database::connect()->prepare('DELETE FROM $table WHERE " . $tabAttribut[0] . "= ?');
        \$query->execute([\$" . $tabAttribut[0] . "]);
    }
    
    public function update($tableMaj \$$table)
    {
        \$query = Database::connect()->prepare('UPDATE $table SET ";

    for ($i = 1; $i < $tailleTab; $i++) {
        $fichierClass .= $tabAttribut[$i] . "=?,";
    }
    $fichierClass = substr($fichierClass, 0, -1);

    $fichierClass .=  " WHERE " . $tabAttribut[0] . " = ?');
        \$query->execute([";

    for ($i = 1; $i < $tailleTab; $i++) {
        $fichierClass .= "\$" . $table . "->get" . ucfirst($tabAttribut[$i]) . "(),";
    }
    $fichierClass .= "\$" . $table . "->get" . ucfirst($tabAttribut[0]) . "()";

    $fichierClass .= "]);
    }
    
    public function insert($tableMaj \$$table)
    {
        \$query = Database::connect()->prepare('INSERT INTO $table (";

    for ($i = 1; $i < $tailleTab; $i++) {
        $fichierClass .= $tabAttribut[$i] . ",";
    }
    $fichierClass = substr($fichierClass, 0, -1);

    $fichierClass .=  ") VALUES (";
    for ($i = 1; $i < $tailleTab; $i++) {
        $fichierClass .= "?,";
    }
    $fichierClass = substr($fichierClass, 0, -1);
    $fichierClass .= ")');
        \$query->execute([";

    for ($i = 1; $i < $tailleTab; $i++) {
        $fichierClass .= "\$" . $table . "->get" . ucfirst($tabAttribut[$i]) . "(),";
    }
    $fichierClass = substr($fichierClass, 0, -1);
    $fichierClass .= "]);
    }
}";

    return $fichierClass;
}

