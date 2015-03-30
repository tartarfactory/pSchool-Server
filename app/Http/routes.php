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
use App\Studies;
use Illuminate\Contracts\Support\Jsonable;

Route::get('csrf', function() {
    return Session::token();
});

Route::group(['prefix' => 'studies'], function()
{

    get('','StudiesController@findMultiResult');

    get('/{id}','StudiesController@findSingleResult');

    post('','StudiesController@inputStudy');

    delete('/{id}','StudiesController@deleteStudy');

    put('/{id}','StudiesController@modificationStudy');

});



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
