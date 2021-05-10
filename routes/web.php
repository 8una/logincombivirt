<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/myprofile', 'HomeController@userProfile')->name('myprofile');

//ADMIN
Route::get('/admin', 'adminController@show')->name('homeAdmin');

//Gestion de combis
Route::get('/gestionCombis', 'adminController@showGestionCombis')->name('gestionDeCombis');
//Crear combi
Route::get('/crearCombi', 'adminController@showCrearCombi')->name('crearCombi');
Route::post('/crearCombi', 'adminController@store')->name('combi.store');
//Combi eliminar
Route::delete('/borrarCombi/{combi}', 'adminController@destroy')->name('combi.borrar');
//Combi Actualizar
Route::patch('/gestionCombis/{combi}', 'adminController@showActCombi')->name('combi.actualizar');
//FIN GESTION DE COMBIS



//RUTAS GESTION DE VIAJES:
Route::get('/gestionDeViajes', 'adminViajesController@showGestionDeViajes')->name('gestionDeViajes');

