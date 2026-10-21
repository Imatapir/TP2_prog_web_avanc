<?php
namespace App\Controllers;

use App\Models\Livre;
use App\Models\Auteur;
use App\Providers\View;
use App\Providers\Validator;


class LivreController{
    
    public function index(){
        $crud = new Livre;
        $livres = $crud->selectAvecAuteur();
        return View::render('livre/index', ['livres' => $livres]);
    }

    public function show(array $data = []){
        if(isset($data['id'])){
            $crud = new Livre;
            $livre = $crud->selectId($data['id']);
            if($livre){
                $crudAuteur = new Auteur;
                $auteur = $crudAuteur->selectId($livre['auteur_id']);
                return View::render('livre/show', ['livre' => $livre, 'auteur' => $auteur]);
            }
        }
        return View::redirect('livres');
    }

    public function create(){
        $crudAuteur = new Auteur;
        $auteurs = $crudAuteur->select('nom');
        return View::render('livre/create', ['auteurs' => $auteurs]);
    }

    public function store(array $data){
        $val = new Validator;
        $val->field('titre', $data['titre'])->required()->max(100);
        $val->field('prix', $data['prix'])->required()->numeric();
        $val->field('stock', $data['stock'])->int();
        $val->field('auteur_id', $data['auteur_id'], 'Auteur')->required()->int();

        if($val->isSuccess()){
            $crud = new Livre;
            $insert = $crud->insert($data);
            if($insert){
                return View::redirect('livre/show?id='.$insert);
            }
            return View::redirect('livres');
        }else{
            $errors = $val->getErrors();
            $crudAuteur = new Auteur;
            $auteurs = $crudAuteur->select('nom');
            return View::render('livre/create', ['errors' => $errors, 'livre' => $data, 'auteurs' => $auteurs]);
        }
    }

    public function edit(array $data = []){
        if(isset($data['id'])){
            $crud = new Livre;
            $livre = $crud->selectId($data['id']);
            if($livre){
                $crudAuteur = new Auteur;
                $auteurs = $crudAuteur->select('nom');
                return View::render('livre/edit', ['livre' =>$livre, 'auteurs' => $auteurs]);
            }
        }
        return View::redirect('livres');
    }

    public function update(array $data, $get = []){
        if(isset($get['id'])){
            $val = new Validator;
            $val->field('titre', $data['titre'])->required()->max(30);
            $val->field('prix', $data['prix'])->required()->numeric();
            $val->field('stock', $data['stock'])->int();
            $val->field('auteur_id', $data['auteur_id'], 'Auteur')->required()->int();

            if($val->isSuccess()){
                $crud = new Livre;
                $crud->update($data, $get['id']);
                return View::redirect('livre/show?id='.$get['id']);
            }else{
                $errors = $val->getErrors();
                $crudAuteur = new Auteur;
                $auteurs = $crudAuteur->select('nom');
                return View::render('livre/edit', ['errors' => $errors, 'livre' => $data, 'auteurs' => $auteurs]);
            }
        }
        return View::redirect('livres');
    }

    public function delete(array $data){
        if(isset($data['id'])){
            $crud = new Livre;
            if($crud->delete($data['id'])){
                return View::redirect('livres');
            }
            $livre = $crud->selectId($data['id']);
            if($livre){
                $crudAuteur = new Auteur;
                $auteur = $crudAuteur->selectId($livre['auteur_id']);
                return View::render('livre/show', [
                    'livre' => $livre,
                    'auteur' => $auteur,
                    'error' => 'Impossible de supprimer ce livre tant qu\'une commande lui est associé'
                ]);
            }
        }
        return View::redirect('livres');
    }
}



