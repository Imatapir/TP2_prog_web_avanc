<?php

namespace App\Controllers;

use App\Models\Commande;
use App\Models\CommandeLivre;
use App\Models\Client;
use App\Models\Livre;
use App\Providers\View;
use App\Providers\Validator;

class CommandeController{

    public function index(){
        $crud = new Commande;
        $commandes = $crud->selectAvecClient();
        return View::render('commande/index', ['commandes' => $commandes]);
    }

    public function show(array $data = []){
        if(isset($data['id'])){
            $crud = new Commande;
            $commande = $crud->selectId($data['id']);
            if($commande){
                $crudClient = new Client;
                $client = $crudClient->selectId($commande['client_id']);
                $crudLigne = new CommandeLivre;
                $lignes = $crudLigne->selectParCommande($data['id']);
                $total = 0;
                foreach($lignes as $i => $ligne){
                    $lignes[$i]['sous_total'] = $ligne['prix'] * $ligne['quantite'];
                    $total += $lignes[$i]['sous_total'];
                }
                return View::render('commande/show', [
                    'commande' => $commande,
                    'client' => $client,
                    'lignes' => $lignes,
                    'total' => $total
                ]);
            }
        }
        return View::redirect('commandes');
    }

        private function donneesPanier(){
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = [];
        }
        $crudLivre = new Livre;
        $lignes = [];
        $total = 0;
        foreach($_SESSION['panier'] as $livreId => $quantite){
            $livre = $crudLivre->selectId($livreId);
            if($livre){
                $sousTotal = $livre['prix'] * $quantite;
                $total += $sousTotal;
                $lignes[] = [
                    'titre' => $livre['titre'],
                    'prix' => $livre['prix'],
                    'quantite' => $quantite,
                    'sous_total' => $sousTotal
                ];
            }
        }
        $crudClient = new Client;
        return [
            'lignes' => $lignes,
            'total' => $total,
            'livres' => $crudLivre->select('titre'),
            'clients' => $crudClient->select('name')
        ];
    }

    public function create(){
        return View::render('commande/create', $this->donneesPanier());
    }

    public function ajouter(array $data){
        $val = new Validator;
        $val->field('livre_id', $data['livre_id'], 'livre')->required()->int();
        $val->field('quantite', $data['quantite'], 'quantité')->required()->int();

        if($val->isSuccess()){
            if(!isset($_SESSION['panier'][$data['livre_id']])){
                $_SESSION['panier'][$data['livre_id']] = 0;
            }
            $_SESSION['panier'][$data['livre_id']] += $data['quantite'];
            return View::redirect('commande/create');
        }
        $errors = $val->getErrors();
        return View::render('commande/create', array_merge($this->donneesPanier(), ['errors' => $errors]));
    }

    public function vider(){
        $_SESSION['panier'] = [];
        return View::redirect('commande/create');
    }

        public function store(array $data){
        $val = new Validator;
        $val->field('client_id', $data['client_id'], 'client')->required()->int();

        $errors = [];
        if(!$val->isSuccess()){
            $errors = $val->getErrors();
        }
        if(empty($_SESSION['panier'])){
            $errors['panier'] = 'Le panier est vide.';
        }
        if(!empty($errors)){
            return View::render('commande/create', array_merge(
                $this->donneesPanier(),
                ['errors' => $errors, 'client_id' => $data['client_id']]
            ));
        }

        $crud = new Commande;
        $commandeId = $crud->insert([
            'client_id' => $data['client_id'],
            'date_commande' => date('Y-m-d')
        ]);
        if($commandeId){
            $crudLigne = new CommandeLivre;
            foreach($_SESSION['panier'] as $livreId => $quantite){
                $crudLigne->insert([
                    'commande_id' => $commandeId,
                    'livre_id' => $livreId,
                    'quantite' => $quantite
                ]);
            }
            $_SESSION['panier'] = [];
            return View::redirect('commande/show?id='.$commandeId);
        }
        return View::redirect('commandes');
    }
}


