<?php

class VillesDAO
{
    public function selectAll()
    {
        $query = Database::connect()->prepare('SELECT * FROM villes');
        $query->execute();
        $villess = $query->fetchAll(PDO::FETCH_ASSOC);
        return $villess;
    }
    
    public function selectOne($id)
    {
        $query = Database::connect()->prepare('SELECT * FROM villes WHERE cp= ?');
        $query->execute([$id]);
        $villes = $query->fetch(PDO::FETCH_ASSOC);
        return $villes;
    }
    
    public function delete($cp)
    {
        $query = Database::connect()->prepare('DELETE FROM villes WHERE cp= ?');
        $query->execute([$cp]);
    }
    
    public function update(Villes $villes)
    {
        $query = Database::connect()->prepare('UPDATE villes SET id_pays=?,nom_ville=?,photo=?,site=? WHERE cp = ?');
        $query->execute([$villes->getId_pays(),$villes->getNom_ville(),$villes->getPhoto(),$villes->getSite(),$villes->getCp()]);
    }
    
    public function insert(Villes $villes)
    {
        $query = Database::connect()->prepare('INSERT INTO villes (id_pays,nom_ville,photo,site) VALUES (?,?,?,?)');
        $query->execute([$villes->getId_pays(),$villes->getNom_ville(),$villes->getPhoto(),$villes->getSite()]);
    }
}