<?php
namespace App\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Providers\View;
use App\Providers\Validator;

class ClientController{
    public function index(){
        $crud = new Client;
        $clients = $crud->select('name');
        return View::render('client/index', ['clients' => $clients]);
    }

    public function show(array $data = []){
        if(isset($data['id'])){
            $crud = new Client;
            $client = $crud->selectId($data['id']);
            if($client){
                $crudCommande = new Commande;
                $commandes = $crudCommande->selectWhere('client_id', $data['id']);
                return View::render('client/show', ['client' => $client, 'commandes' => $commandes]);
            }
        }
        return View::redirect('clients');
    }

    public function create(){
        return View::render('client/create');
    }

    public function store(array $data){
        $val = new Validator;
        $val->field('name', $data['name'], 'nom')->required()->max(50);
        $val->field('address', $data['address'], 'addresse')->max(50);
        $val->field('zip_code', $data['zip_code'], 'code postal')->max(10);
        $val->field('phone', $data['phone'], 'telephone')->max(15);
        $val->field('email', $data['email'], 'courriel')->max(30)->email();

        if($val->isSuccess()){
            $crud = new Client;
            $insert = $crud->insert($data);
            if($insert){
                return View::redirect('client/show?id='.$insert);
            }
            return View::redirect('clients');
        }else{
            $errors = $val->getErrors();
            return View::render('client/create', ['errors' => $errors, 'client' => $data]);
        }
    }

    public function edit(array $data = []){
        if(isset($data['id'])){
            $crud = new Client;
            $client = $crud->selectId($data['id']);
            if($client){
                return View::render('client/edit', ['client' => $client]);
            }
        }
        return View::redirect('clients');
    }

    public function update(array $data, $get = []){
        if(isset($get['id'])){
            $val = new Validator;
            $val->field('name', $data['name'], 'nom')->required()->max(50);
            $val->field('address', $data['address'], 'addresse')->max(50);
            $val->field('zip_code', $data['zip_code'], 'code postal')->max(10);
            $val->field('phone', $data['phone'], 'telephone')->max(15);
            $val->field('email', $data['email'], 'courriel')->max(30)->email();

            if($val->isSuccess()){
                $crud = new Client;
                $crud->update($data, $get['id']);
                return View::redirect('client/show?id='.$get['id']);
            }else{
                $errors = $val->getErrors();
                return View::render('client/edit', ['errors' => $errors, 'client' => $data]);
            }
        }
        return View::redirect('clients');
    }

    public function delete(array $data){
        if(isset($data['id'])){
            $crud = new Client;
            if($crud->delete($data['id'])){
                return View::redirect('clients');
            }
            $client = $crud->selectId($data['id']);
            if($client){
            $crudCommande = new Commande;
            $commandes = $crudCommande->selectWhere('client_id', $data['id']);
            return View::render('client/show',[
                'client' => $client,
                'commandes' => $commandes,
                'error' => 'Impossible de supprimer ce client tant qu\'une commande lui est associé'
            ]);
            }
        }
        return View::redirect('clients');
    }

}


