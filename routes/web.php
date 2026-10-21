<?php
use App\Routes\Route;

Route::get('/', 'HomeController@index');

Route::get('/auteurs', 'AuteurController@index');
Route::get('/auteur/show', 'AuteurController@show');
Route::get('/auteur/create', 'AuteurController@create');
Route::post('/auteur/create', 'AuteurController@store');
Route::get('/auteur/edit', 'AuteurController@edit');
Route::post('/auteur/edit', 'AuteurController@update');
Route::post('/auteur/delete', 'AuteurController@delete');

Route::get('/livres', 'LivreController@index');
Route::get('/livre/show', 'LivreController@show');
Route::get('/livre/create', 'LivreController@create');
Route::post('/livre/create', 'LivreController@store');
Route::get('/livre/edit', 'LivreController@edit');
Route::post('/livre/edit', 'LivreController@update');
Route::post('/livre/delete', 'LivreController@delete');

Route::get('/clients', 'ClientController@index');
Route::get('/client/show', 'ClientController@show');
Route::get('/client/create', 'ClientController@create');
Route::post('/client/create', 'ClientController@store');
Route::get('/client/edit', 'ClientController@edit');
Route::post('/client/edit', 'ClientController@update');
Route::post('/client/delete', 'ClientController@delete');

Route::get('/commandes', 'CommandeController@index');
Route::get('/commande/show', 'CommandeController@show');
Route::get('/commande/create', 'CommandeController@create');
Route::post('/commande/ajouter', 'CommandeController@ajouter');
Route::post('/commande/vider', 'CommandeController@vider');
Route::post('/commande/create', 'CommandeController@store');


Route::dispatch();