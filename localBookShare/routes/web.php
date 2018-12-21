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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

### Users Route ###

//************************ ### ************************/\\

### Admin Route ###
Route::get('/admin', 'AdminController@index');

Route::get('/admin/add_book', 'AdminController@addBookSite');

Route::post('/admin/add_book', 'AdminController@addBook');

Route::get('/admin/all_books/{page}/{language}', 'AdminController@allBooksSite');

