<?php

namespace App\Models;

class Commande extends CRUD{
    protected $table = 'commande';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'date_commande'];

    public function selectAvecClient(){
        $sql = "SELECT commande.id, commande.date_commande, client.name AS client_name,
                       SUM(commande_livre.quantite * livre.prix) AS total
                FROM commande
                INNER JOIN client ON commande.client_id = client.id
                INNER JOIN commande_livre ON commande_livre.commande_id = commande.id
                INNER JOIN livre ON commande_livre.livre_id = livre.id
                GROUP BY commande.id, commande.date_commande, client.name
                ORDER BY commande.date_commande DESC, commande.id DESC";
        return $this->query($sql)->fetchAll();
    }
}

