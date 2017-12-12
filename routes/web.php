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

Auth::routes();

Route::get('changerMdp','HomeController@editPassword')->middleware('auth');
Route::put('changerMdp','HomeController@updatePassword')->middleware('auth');

Route::group(['middleware' => ['auth','checkPassword']], function () {
	Route::get('/', 'HomeController@index');
	Route::get('bilanPDF', 'PdfController@index');

Route::group(['middleware' => 'teacher'], function () {
		Route::resource('classes','GroupController');
		Route::resource('users','UserController');
		Route::post('classes/{class}/importerOds','UserController@OdsImport');
		Route::get('classes/{id}/datatables/users','DatatablesController@showGroupDatatables');
		Route::get('activites/datatables','DatatablesController@showActivitiesDatatables');
		Route::get('classes/{id}/ajouterEleve', 'UserController@get_addUserInGroup');
		Route::post('classes/{id}/ajouterEleve', 'UserController@post_addUserInGroup');
		Route::get('situations/datatables','DatatablesController@showSituationsDatatables');

	});
	//Middleware géré directement dans le constructeur de SituationController
	Route::resource('situation', 'SituationController');

	Route::post('situation/{situation}/comment','CommentController@store')->name('comment.store');
	Route::delete('comment/{comment}','CommentController@destroy')->name('comment.destroy');

	Route::group(['middleware' => 'admin'], function () {
		Route::get('admin', 'HomeController@admin');
		Route::resource('professeurs', 'TeacherController');
		Route::resource('categories', 'CategoryController');
		Route::resource('activites', 'ActivityController');
		Route::resource('activites_principales', 'MainActivityController');
	});

});
