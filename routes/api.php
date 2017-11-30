<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// GET
Route::get('/recipes/{id}', 'RecipesController@show');
Route::get('/recipes/cuisine/{cuisine}', 'RecipesController@showByCuisine');

// POST
Route::post('/recipe/rate', 'RecipesController@rate');
Route::post('/recipes', 'RecipesController@store');

// PUT
Route::put('/recipes/{id}', 'RecipesController@update');
