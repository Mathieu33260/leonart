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

Route::get('/contact', 'PageController@contact')
    ->name('page:contact');

Route::get('/mentions-legales', 'PageController@mentions')
    ->name('page:mentions');

Route::post('/contactPost', 'PageController@contactPost')
    ->name('page:contactPost');

Route::get('/map', 'PageController@map')
        ->name('page:map');

Route::get('/{page}', 'PageController@show')
    ->where(['page' => 'services|conditions'])
    ->name('page:show');


/* Admin*/

Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::middleware(['admin'])->group(function () {

        Route::get('/edit', 'AdminController@edit')
            ->name('admin:profil:edit');

        Route::patch('/save', 'AdminController@save')
            ->name('admin:profil:save');

        Route::get('/manage', 'AdminController@manage')
            ->name('admin:manage');

        Route::get('/manageAjax/{offset}/{string?}','AdminController@manageAjax')
            ->where(['offset' => '[0-9]+'], ['string' => '[A-Za-z]+'])
            ->name('admin:manageAjax');

        Route::post('/manageStore/{id}', 'AdminController@manageStore')
            ->where(['id' => '[0-9]+'])
            ->name('admin:manageStore');

    });

});


/* User */

Route::prefix('user')->namespace('User')->group(function () {

    Route::middleware(['user'])->group(function () {

        Route::get('users/edit', 'UserController@edit')
            ->name('user:profil:edit');

        Route::patch('users', 'UserController@save')
            ->name('user:profil:save');

        Route::get('/home', 'UserController@index')
            ->name('user:home');

    });

});

/* Guest */

Route::prefix('guestuser')->namespace('Guestuser')->group(function () {

    Route::middleware(['guestuser'])->group(function () {

        Route::get('/edit', 'GuestuserController@edit')
            ->name('guestuser:profil:edit');

        Route::patch('/save', 'GuestuserController@save')
            ->name('guestuser:profil:save');

        Route::get('/home', 'GuestuserController@index')
            ->name('guestuser:home');


    });

});


Route::middleware(['user'])->group(function () {

    /* Type */

    Route::prefix('type')->namespace('Type')->group(function () {

        Route::middleware(['auth'])->group(function () {

            Route::get('/','TypeController@index')
                ->name('type:index');

            Route::get('/indexAjax/{offset}/{string?}','TypeController@indexAjax')
                ->where(['offset' => '[0-9]+'], ['string' => '[A-Za-z]+'])
                ->name('type:indexAjax');

            Route::get('/{id}','TypeController@show')
                ->where(['id' => '[0-9]+'])
                ->name('type:show');

            Route::get('/create','TypeController@create')
                ->name('type:create');

            Route::post('/store','TypeController@store')
                ->name('type:store');

            Route::post('/update/{id}','TypeController@update')
                ->where(['id' => '[0-9]+'])
                ->name('type:update');

            Route::get('/destroy/{id}','TypeController@destroy')
                ->where(['id' => '[0-9]+'])
                ->name('type:destroy');

        });

    });




    /* Oeuvre */

    Route::prefix('oeuvre')->namespace('Oeuvres')->group(function () {

        Route::middleware(['auth'])->group(function () {

            Route::get('/','OeuvresController@index')
                ->name('oeuvre:index');

            Route::get('/indexAjax/{offset}/{string?}','OeuvresController@indexAjax')
                ->where(['offset' => '[0-9]+'], ['string' => '[A-Za-z]+'])
                ->name('oeuvre:indexAjax');

            Route::get('/{id}','OeuvresController@show')
                ->where(['id' => '[0-9]+'])
                ->name('oeuvre:show');

            Route::get('/create','OeuvresController@create')
                ->name('oeuvre:create');

            Route::post('/store','OeuvresController@store')
                ->name('oeuvre:store');

            Route::post('/update/{id}','OeuvresController@update')
                ->where(['id' => '[0-9]+'])
                ->name('oeuvre:update');

            Route::get('/destroy/{id}','OeuvresController@destroy')
                ->where(['id' => '[0-9]+'])
                ->name('oeuvre:destroy');

        });

    });




    /* Artiste */

    Route::prefix('artiste')->namespace('Artiste')->group(function () {

        Route::middleware(['auth'])->group(function () {

            Route::get('/','ArtisteController@index')
                ->name('artiste:index');

            Route::get('/indexAjax/{offset}/{string?}','ArtisteController@indexAjax')
                ->where(['offset' => '[0-9]+'], ['string' => '[A-Za-z]+'])
                ->name('artiste:indexAjax');

            Route::get('/{id}','ArtisteController@show')
                ->where(['id' => '[0-9]+'])
                ->name('artiste:show');

            Route::get('/create','ArtisteController@create')
                ->name('artiste:create');

            Route::post('/store','ArtisteController@store')
                ->name('artiste:store');

            Route::post('/update/{id}','ArtisteController@update')
                ->where(['id' => '[0-9]+'])
                ->name('artiste:update');

            Route::get('/destroy/{id}','ArtisteController@destroy')
                ->where(['id' => '[0-9]+'])
                ->name('artiste:destroy');

        });

    });

});

Auth::routes();
