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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/myprofile', 'HomeController@userProfile')->name('myprofile');

//ADMIN
Route::get('/admin', 'adminController@show')->name('uAdmin');

//Gestion de combis
Route::post('/buscarCombi', 'adminController@showBuscarCombi')->name('buscarCombi');

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
Route::post('/itemCargado','ItemController@crear')->name('item.cargado');
Route::get('/updateItem/{item}','ItemController@actualizarForm')->name('item.update');
Route::patch('/itemActualizado/{item}','ItemController@actualizar')->name('item.actualizado');
Route::delete('/itemBorrado/{item}','ItemController@eliminar')->name('item.borrar');
//FIN GESTION DE ITEMS

//Gestion de choferes
Route::get('/gestionDeChoferes','ChoferController@index')->name('chofer.index');
Route::get('/updateChofer/{chofer}','ChoferController@actualizarForm')->name('chofer.update');
Route::get('/createChofer','ChoferController@crearForm')->name('chofer.crear');
Route::post('/choferCargado','ChoferController@crear')->name('chofer.creado');
Route::patch('/ChoferActualizado/{chofer}','ChoferController@actualizar')->name('chofer.actualizado');
Route::delete('/choferBorrado/{chofer}','ChoferController@eliminar')->name('chofer.borrado');
Route::get('/choferPerfil/{chofer}','ChoferController@perfil')->name('chofer.perfil');
//FIN GESTION DE CHOFERES


//RUTAS GESTION DE VIAJES:
Route::get('/gestionDeViajes', 'adminViajesController@showGestionDeViajes')->name('gestionDeViajes');
//Creacion de viaje
Route::get('/crearViaje', 'adminViajesController@create')->name('crearViaje');
Route::get('/selectCombiYChofer', 'adminViajesController@selectcombiYChofer')->name('selectCombiYChofer');
Route::post('/selectCombiYChofer', 'adminViajesController@crearviaje')->name('crearviaje');
//FIN CREACION DE VIAJES
//Eliminar Viajes:
Route::delete('/borrarViaje/{viaje}/{patente}', 'adminViajesController@borrarviaje')->name('viaje.borrar');
//REPROGRRAMAR VIAJE:
Route::get('/viajeactualizar/{viaje}', 'adminViajesController@showActForm')->name('viaje.actualizar');
Route::get('/viajeactualizarcombiYChofer/{viaje}', 'adminViajesController@selectCombiYChoferActualizar')->name('selectCombiYChoferActualizar');
Route::patch('/viajeactualizarfin/{viaje}', 'adminViajesController@actualizarViaje')->name('viajeactualizarfin');

//VIAJES DE USUARIO:
Route::get('/misViajes/{dni}', 'userViajesController@showMisViajes')->name('misViajes');
Route::get('/misViajesPasados/{dni}', 'userViajesController@showMisViajesPasados')->name('misViajesPasados');
Route::get('/viajesDelUsuario', 'userViajesController@viajesDelUsuario')->name('viajesDelUsuario');
//Reprogramar viaje
Route::post('/reprogramar/{dni}/{ruta}/{idviaje}', 'userViajesController@reprogramarViaje')->name('reprogramar');
Route::post('/actualizar/{dni}/{idviajeviejo}/{idviajenuevo}', 'userViajesController@actualizarViaje')->name('actualizar');
//Comprar viaje

Route::get('/agregarItemViaje/{item}/{viaje]', 'userViajesController@agregarItemAViaje')->name('item.agregarCarro');
Route::get('/comprarViaje/{viaje}', 'userViajesController@compraItems')->name('compraItems');
Route::get('/pagarViaje/{viaje}', 'userViajesController@formPago')->name('pagarViaje');
Route::post('/viajePagado/{viaje}', 'userViajesController@agregarViajeAUsuario')->name('pagarViajeConfirmado');

//Cancelar viaje
Route::delete('/cancelarViaje/{dni}/{viaje}', 'userViajesController@cancelarViaje')->name('cancelarViaje');
//Ordenar viajes del usuario:
Route::get('/misViajes/', 'userViajesController@showMisViajesOrdenados')->name('ordenarViaje');



//GESTION DE RUTAS ENTONCES
Route::get('/administracionRuta', 'adminRutasController@showindex')->name('ruta.index');
Route::get('/crearRuta', 'adminRutasController@crearRuta')->name('crearRuta');
Route::get('/elegirDestino', 'adminRutasController@elegirDestino')->name('selectDestino');
Route::post('/elegirDestino', 'adminRutasController@cargarNuevaRuta')->name('cargarNuevaRuta');
//borrar Ruta
Route::delete('/borrarRuta/{ruta}', 'adminRutasController@borrarRuta')->name('ruta.borrar');

//buscarRuta
Route::post('/buscarPorRuta', 'adminRutasController@buscarRuta')->name('buscarRuta');
Route::post('/buscarPorRutaPorOrigen', 'adminRutasController@buscarRutaPorOrigen')->name('buscarRutaPorOrigen');
Route::post('/buscarPorRutaPorDestino', 'adminRutasController@buscarRutaPorDestino')->name('buscarRutaPorDestino');

//Crear ciudad:
Route::get('/agregarCiudad', 'adminRutasController@crearCiudad')->name('crearCiudad');
Route::post('/agregarCiudad', 'adminRutasController@cargarNuevaCiudad')->name('cargarNuevaCiudad');
//quitar ciudad:
Route::get('/quitarCiudad', 'adminRutasController@quitarCiudad')->name('quitarCiudad');
Route::delete('/borrarciudad', 'adminRutasController@borrarciudad')->name('borrarciudad');

//calificaciones de viajes
Route::get('/calificarViaje/{usuario}', 'userViajesController@calificarviaje')->name('calificarviaje');
Route::post('/usuarioCalificaViaje/{viaje}', 'userViajesController@usuarioCalificaViaje')->name('usuarioCalificaViaje');