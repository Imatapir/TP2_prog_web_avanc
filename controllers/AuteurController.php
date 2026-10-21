<?php
namespace App\Controllers;

use App\Models\Auteur;
use App\Models\Livre;
use App\Providers\View;
use App\Providers\Validator;

class AuteurController{
    public function index(){
        $crud = new Auteur;
        $auteurs = $crud->select('nom');
        return View::render('auteur/index', ['auteurs' => $auteurs]);
    }

    public function show(array $data = []){
        if(isset($data['id'])){
            $crud = new Auteur;
            $auteur = $crud->selectId($data['id']);
            if($auteur){
                $crudLivre = new Livre;
                $livres = $crudLivre->selectWhere('auteur_id', $data['id']);
                return View::render('auteur/show', ['auteur' => $auteur, 'livres' => $livres]);
            }
        }
        return View::redirect('auteurs');
    }

    public function create(){
        return View::render('auteur/create');
    }

    public function store(array $data){
        $val = new Validator;
        $val->field('nom', $data['nom'])->required()->max(30);
        $val->field('prenom', $data['prenom'])->required()->max(30);

        if($val->isSuccess()){
            $crud = new Auteur;
            $insert = $crud->insert($data);
            if($insert){
                return View::redirect('auteur/show?id='.$insert);
            }
            return View::redirect('auteurs');
        }else{
            $errors = $val->getErrors();
            return View::render('auteur/create', ['errors' => $errors, 'auteur' => $data]);
        }
    }

    public function edit(array $data = []){
        if(isset($data['id'])){
            $crud = new Auteur;
            $auteur = $crud->selectId($data['id']);
            if($auteur){
                return View::render('auteur/edit', ['auteur' => $auteur]);
            }
        }
        return View::redirect('auteurs');
    }

    public function update(array $data, $get = []){
        if(isset($get['id'])){
            $val = new Validator;
            $val->field('nom', $data['nom'])->required()->max(30);
            $val->field('prenom', $data['prenom'])->required()->max(30);

            if($val->isSuccess()){
            $crud = new Auteur;
            $crud->update($data, $get['id']);
            return View::redirect('auteur/show?id='.$get['id']);
            }else{
                $errors = $val->getErrors();
                return View::render('auteur/edit', ['errors' => $errors, 'auteur' => $data]);
            }
        }
        return View::redirect('auteurs');
    }

    public function delete(array $data){
        if(isset($data['id'])){
            $crud = new Auteur;
            if($crud->delete($data['id'])){
                return View::redirect('auteurs');
            }
            $auteur = $crud->selectId($data['id']);
            if($auteur){
                $crudLivre = new Livre;
                $livres = $crudLivre->selectWhere('auteur_id', $data['id']);
                return View::render('auteur/show', [
                    'auteur' => $auteur,
                    'livres' => $livres,
                    'error' => 'Impossible de supprimer cet auteur tant que des livres y sont associés'
                ]);
            }
        }
        return View::redirect('auteurs');
    }
}


