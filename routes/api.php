<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Route::group([
//     'prefix' => 'auth',
//     'namespace' => 'App\Http\Controllers',
// ], function () {
//     Route::post('login', 'AuthController@login');
//     Route::post('signup', 'AuthController@signUp');

//     Route::group([
//             'middleware' => 'auth:api'
//         ], function() {
//             Route::get('logout', 'AuthController@logout');
//             Route::get('user', 'AuthController@user');
//             Route::prefix('v1')->group( function(){
//                 Route::resource('marca', 'api\v1\MarcaController', [ 'except' => ['edit','create']]);
//                 Route::resource('modelo', 'api\v1\ModeloController', [ 'except' => ['edit','create']]);
//                 Route::resource('categoria','api\v1\CategoriasController', [ 'except' => ['edit','create']]);

//         });
//     });
// });

use App\Http\Controllers\api\v1\MarcaController;
use App\Http\Controllers\api\v1\ModeloController;
use App\Http\Controllers\api\v1\CategoriasController;
use App\Http\Controllers\api\v1\TipoProductosController;

Route::prefix('v1')
            ->group( function(){
                    Route::resource('marca', MarcaController::class);
                    Route::resource('modelo', ModeloController::class);
                    Route::resource('categoria',CategoriasController::class, [ 'except' => ['edit','create']]);
                    Route::resource('tipoproductos',TipoProductosController::class, [ 'except' => ['edit','create']]);
    
            });