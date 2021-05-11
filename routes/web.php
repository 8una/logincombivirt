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

Route::get('/', function () {
    return view('welcome');
});

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
//Gestion de items
Route::get('/gestionDeItems','ItemController@index')->name('item.index');
Route::get('/crearItem','ItemController@crearForm')->name ('item.crear');
Route::post('/itemCargado','ItemController@crear');
Route::get('/updateItem/{item}','ItemController@actualizarForm')->name('item.update');
Route::patch('/itemActualizado/{item}','ItemController@actualizar')->name('item.actualizado');
Route::delete('/itemBorrado/{item}','ItemController@eliminar')->name('item.borrar');

//FIN GESTION DE ITEMS

//Gestion de choferes
Route::get('/gestionDeChoferes','ChoferController@index')->name('chofer.index');
Route::get('/updateChofer/{chofer}','ChoferController@actualizarForm')->name('chofer.update');
Route::get('/createChofer','ChoferController@crearForm');
Route::post('/choferCargado','ChoferController@crear')->name('chofer.creado');
Route::patch('/ChoferActualizado/{chofer}','ChoferController@actualizar')->name('chofer.actualizado');
Route::delete('/choferBorrado/{chofer}','ChoferController@eliminar')->name('chofer.borrado');
Route::get('/choferPerfil/{chofer}','ChoferController@perfil')->name('chofer.perfil');
//FIN GESTION DE CHOFERES



//RUTAS GESTION DE VIAJES:
Route::get('/gestionDeViajes', 'adminViajesController@showGestionDeViajes')->name('gestionDeViajes');

