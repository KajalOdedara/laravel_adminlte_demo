<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
	return view('welcome');
});
// Route::get('/admin', function () {
// 	return view('layouts.admin');
// });

Auth::routes();


// category manual route 
// Route::get('/admin/categories', 'CategoriesController@index')->name('list_category');
// Route::get('/admin/categories/details/{id}', 'CategoriesController@details')->name('list_category_details');


// category resource route


Route::prefix('admin')->as('admin.')->namespace('admin')->middleware('auth')->group(function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::resource('/categories', 'CategoriesController');
	Route::resource('/news', 'NewsController');
});

// social login

Route::namespace('admin')->group(function(){
	Route::get('login/{provider}', 'SocialController@redirect');
	Route::get('login/{provider}/callback','SocialController@Callback');
});

//user 

Route::namespace('user')->middleware('auth')->group(function(){
	Route::get('/user', 'UserController@index')->name('user');
	Route::get('/status/update', 'UserController@updateStatus')->name('users.update.status');

});
// for change password

Route::get('change_password','Auth\ChangePasswordController@showChangePasswordForm');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// for testing

Route::get('/mylayout', function () {
	return view('mylayout');
});
