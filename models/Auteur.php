<?php

namespace App\Models;

class Auteur extends CRUD{
    protected $table = 'auteur';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'prenom'];
}

