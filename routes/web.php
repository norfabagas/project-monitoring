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
Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', function () {
    if (Auth::check()) {
      return redirect('admin');
    } else {
      return redirect('login');
    }
});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/', 'AdminController@index');
  Route::get('/project', 'AdminController@project');
  Route::get('/project-json', 'ProjectController@table');
  Route::resource('project-rest', 'ProjectController');
});

Route::get('/home', 'HomeController@index')->name('home');
