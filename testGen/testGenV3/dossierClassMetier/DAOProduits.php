<?php

class ProduitsDAO
{
    public function selectAll()
    {
        $query = Database::connect()->prepare('SELECT * FROM produits');
        $query->execute();
        $produitss = $query->fetchAll(PDO::FETCH_ASSOC);
        return $produitss;
    }
    
    public function selectOne($id)
    {
        $query = Database::connect()->prepare('SELECT * FROM produits WHERE id_produit= ?');
        $query->execute([$id]);
        $produits = $query->fetch(PDO::FETCH_ASSOC);
        return $produits;
    }
    
    public function delete($id_produit)
    {
        $query = Database::connect()->prepare('DELETE FROM produits WHERE id_produit= ?');
        $query->execute([$id_produit]);
    }
    
    public function update(Produits $produits)
    {
        $query = Database::connect()->prepare('UPDATE produits SET designation=?,prix=?,qte_stockee=?,photo=?,categorie=? WHERE id_produit = ?');
        $query->execute([$produits->getDesignation(),$produits->getPrix(),$produits->getQte_stockee(),$produits->getPhoto(),$produits->getCategorie(),$produits->getId_produit()]);
    }
    
    public function insert(Produits $produits)
    {
        $query = Database::connect()->prepare('INSERT INTO produits (designation,prix,qte_stockee,photo,categorie) VALUES (?,?,?,?,?)');
        $query->execute([$produits->getDesignation(),$produits->getPrix(),$produits->getQte_stockee(),$produits->getPhoto(),$produits->getCategorie()]);
    }
}