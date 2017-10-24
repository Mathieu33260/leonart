<?php

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


    Route::get('/oeuvre', 'OeuvreController@index')
        ->name('user:oeuvre:index');

    Route::get('/oeuvre/{id}', 'OeuvreController@show')
        ->where(['id' => '[0-9]+'])
        ->name('user:oeuvre:show');

    Route::get('/artiste', 'ArtisteController@index')
        ->name('user:artiste:index');


    Route::get('users/edit', 'UserController@edit')
        ->name('user:profil:edit');

    Route::patch('users', 'UserController@save')
        ->name('user:profil:save');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
