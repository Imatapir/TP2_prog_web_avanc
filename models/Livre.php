<?php

namespace App\Models;

class Livre extends CRUD{
    protected $table = 'livre';
    protected $primaryKey = 'id';
    protected $fillable = ['titre', 'prix', 'stock', 'auteur_id'];

    public function selectAvecAuteur(){
        $sql = "SELECT livre.*, auteur.nom AS auteur_nom, auteur.prenom AS auteur_prenom
                FROM livre
                INNER JOIN auteur ON livre.auteur_id = auteur.id
                ORDER BY livre.titre";
        return $this->query($sql)->fetchAll();
    }
}

