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

Route::group([
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signUp');

    Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
            Route::prefix('v1')->group( function(){
                Route::resource('marca', 'api\v1\MarcaController');
                Route::resource('modelo', 'api\v1\ModeloController');
                Route::resource('categoria','api\v1\CategoriasController', [ 'except' => ['edit','create']]);

        });
    });
});
