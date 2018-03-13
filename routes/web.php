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
	Route::get('bilanPDF/{id}', 'SuiviSio\PdfController@index');
	Route::get('changerNumeroCandidat', 'UserController@editNumeroCandidat');
	Route::post('changerNumeroCandidat', 'UserController@storeNumeroCandidat');

	Route::group(['middleware' => 'teacher'], function () {
		Route::resource('classes','SuiviSio\GroupController');
		Route::resource('users','UserController');
		Route::get('users/{id}/situations','SuiviSio\SituationController@forUser');
		Route::post('classes/{class}/importerOds','UserController@OdsImport');
		Route::get('classes/{id}/datatables/users','SuiviSio\DatatablesController@showGroupDatatables');
		Route::get('activites/datatables','SuiviSio\DatatablesController@showActivitiesDatatables');
		Route::get('classes/{id}/ajouterEleve', 'UserController@get_addUserInGroup');
		Route::post('classes/{id}/ajouterEleve', 'UserController@post_addUserInGroup');
		Route::get('situations/datatables','SuiviSio\DatatablesController@showSituationsDatatables');
		Route::get('classes/{id}/bilanPDF', 'SuiviSio\PdfController@group');


	});
	//Middleware géré directement dans le constructeur de SituationController
	Route::resource('situation', 'SuiviSio\SituationController');

	Route::post('situation/{situation}/comment','SuiviSio\CommentController@store')->name('comment.store');
	Route::delete('comment/{comment}','SuiviSio\CommentController@destroy')->name('comment.destroy');

	Route::group(['middleware' => 'admin'], function () {
		Route::get('admin', 'HomeController@admin');
		Route::resource('professeurs', 'SuiviSio\TeacherController');
		Route::resource('categories', 'SuiviSio\CategoryController');
		Route::resource('activites', 'SuiviSio\ActivityController');
		Route::resource('activites_principales', 'SuiviSio\MainActivityController');
	});

});
