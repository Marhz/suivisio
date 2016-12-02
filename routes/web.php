<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'HomeController@index');

});

Route::group(['middleware' => 'teacher'], function () {
	Route::resource('classes','GroupController');
	Route::resource('users','UserController');
	Route::post('classes/{class}/importerCsv','UserController@OdsImport');
	Route::get('classes/{id}/datatables/users','DatatablesController@showGroupDatatables');
	Route::get('classes/{id}/ajouterEleve', 'UserController@get_addUserInGroup');
	Route::post('classes/{id}/ajouterEleve', 'UserController@post_addUserInGroup');

});

Route::group(['middleware' => 'admin'], function () {

});

