<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Boards;
use Illuminate\Contracts\Support\Jsonable;

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

get('/boards','BoardsController@index');

get('/boards/{id}','BoardsController@info');

Route::get('csrf', function() {
    return Session::token();
});

post('/boards/write','BoardsController@writeDocument');

put('/boards/{id}','BoardsController@updateDocument');

delete('/boards/{id}','BoardsController@deleteDocument');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
