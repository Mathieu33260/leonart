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

Route::get('/', 'PageController@index')
    ->name('page:index');

Route::get('/{page}', 'PageController@show')
    ->where(['page' => 'services|conditions'])
    ->name('page:show');

Route::get('/home', 'HomeController@index')->name('home');


/* Admin*/


Route::prefix('user')->namespace('User')->group(function () {


    /* User */

    Route::get('users/edit', 'UserController@edit')
        ->name('user:profil:edit');

    Route::patch('users', 'UserController@save')
        ->name('user:profil:save');
});




/* Type */

Route::prefix('type')->namespace('Type')->group(function () {

    Route::get('/','TypeController@index')
        ->name('type:index');

    Route::get('/{id}','TypeController@show')
        ->where(['id' => '[0-9]+'])
        ->name('type:show');

    Route::get('/showAjax/{id}','TypeController@showAjax')
        ->where(['id' => '[0-9]+'])
        ->name('type:showAjax');

    Route::get('/create','TypeController@create')
        ->name('type:create');

    Route::patch('/store','TypeController@store')
        ->name('type:store');

    Route::get('/edit/{id}','TypeController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('type:edit');

    Route::patch('/update/{id}','TypeController@update')
        ->where(['id' => '[0-9]+'])
        ->name('type:update');

    Route::get('/destroy/{id}','TypeController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('type:destroy');

});




/* Oeuvre */

Route::prefix('oeuvre')->namespace('Oeuvres')->group(function () {

    Route::get('/','OeuvresController@index')
        ->name('oeuvre:index');

    Route::get('/{id}','OeuvresController@show')
        ->where(['id' => '[0-9]+'])
        ->name('oeuvre:show');

    Route::get('/showAjax/{id}','OeuvresController@showAjax')
        ->where(['id' => '[0-9]+'])
        ->name('oeuvre:showAjax');

    Route::get('/create','OeuvresController@create')
        ->name('oeuvre:create');

    Route::patch('/store','OeuvresController@store')
        ->name('oeuvre:store');

    Route::get('/edit/{id}','OeuvresController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('oeuvre:edit');

    Route::patch('/update/{id}','OeuvresController@update')
        ->where(['id' => '[0-9]+'])
        ->name('oeuvre:update');

    Route::get('/destroy/{id}','OeuvresController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('oeuvre:destroy');

});




/* Artiste */

Route::prefix('artiste')->namespace('Artiste')->group(function () {

    Route::get('/','ArtisteController@index')
        ->name('artiste:index');

    Route::get('/{id}','ArtisteController@show')
        ->where(['id' => '[0-9]+'])
        ->name('artiste:show');

    Route::get('/showAjax/{id}','ArtisteController@showAjax')
        ->where(['id' => '[0-9]+'])
        ->name('artiste:showAjax');

    Route::get('/create','ArtisteController@create')
        ->name('artiste:create');

    Route::patch('/store','ArtisteController@store')
        ->name('artiste:store');

    Route::get('/edit/{id}','ArtisteController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('artiste:edit');

    Route::patch('/update/{id}','ArtisteController@update')
        ->where(['id' => '[0-9]+'])
        ->name('artiste:update');

    Route::get('/destroy/{id}','ArtisteController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('artiste:destroy');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
