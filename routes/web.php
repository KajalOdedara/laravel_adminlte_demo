<?php

use App\Http\Controllers\CategoriesController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\admin\ImagesController;
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

Auth::routes();

Route::middleware('can:isAdmin')->group(function () {
	Route::get('/news', 'Admin\NewsController@export')->name('exportexcel');
	
});

// category resource route

// Route::get('/news', 'Admin\NewsController@export')->name('exportexcel');
Route::get('/newscsv', 'Admin\NewsController@exportcsv')->name('exportcsv');
// Route::get('/newspdf', 'Admin\NewsController@exportpdf')->name('exportpdf');


Route::get('categorysearch', 'Admin\CategoriesController@result');
Route::get('search', 'Admin\NewsController@result');

Route::prefix('admin')->as('admin.')->namespace('admin')->middleware('auth')->group(function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/search', 'CategoriesController@search')->name('searchoption');
	Route::resource('/categories', 'CategoriesController');
	Route::resource('/news', 'NewsController');
});

// social login

Route::namespace('admin')->group(function () {
	Route::get('login/{provider}', 'SocialController@redirect');
	Route::get('login/{provider}/callback', 'SocialController@Callback');

	// image upload

	Route::get('/uploadfile', 'UploadfileController@index')->name('imageindex');
	Route::post('/uploadfile', 'UploadfileController@upload');

	// image upload using ajax

	Route::get('/ajax_upload', 'AjaxUploadController@index_ajax')->name('imageuploadajax');
	Route::post('/ajax_upload/action', 'AjaxUploadController@action')->name('ajaxupload.action');

	Route::get('/image_crop', 'AjaxUploadController@index_crop')->name('cropimage');
	Route::post('/image_crop/upload', 'AjaxUploadController@upload')->name('image_crop.upload');

	// Gallery route

	Route::get('/getlist', array('as' => 'index', 'uses' => 'AlbumsController@getList'));
	Route::get('/createalbum', array('as' => 'create_album_form', 'uses' => 'AlbumsController@getForm'));
	Route::post('/createalbum', array('as' => 'create_album', 'uses' => 'AlbumsController@postCreate'));
	Route::get('/deletealbum/{id}', array('as' => 'delete_album', 'uses' => 'AlbumsController@getDelete'));
	Route::get('/album/{id}', array('as' => 'show_album', 'uses' => 'AlbumsController@getAlbum'));
	Route::get('/addimage/{id}', array('as' => 'add_image', 'uses' => 'ImagesController@getForm'));
	Route::post('/addimage', array('as' => 'add_image_to_album', 'uses' => 'ImagesController@postAdd'));
	Route::get('/deleteimage/{id}', array('as' => 'delete_image', 'uses' => 'ImagesController@getDelete'));
	Route::post('/moveimage', array('as' => 'move_image', 'uses' => 'ImagesController@postMove'));
});

//user 

Route::namespace('user')->middleware('auth')->group(function () {
	Route::get('/user', 'UserController@index')->name('user');
	Route::post('/search', 'UserController@search');
	Route::get('/status/update', 'UserController@updateStatus')->name('users.update.status');
});
// for change password

Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
