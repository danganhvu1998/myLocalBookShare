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

# Users Controller

Route::get('my_info/edit', "UsersController@editInformationsSite");

Route::post('my_info/edit', "UsersController@editInformations");

Route::get('all_books/{page}/{language}', 'BooksController@allBooksSite');

//************************ ### ************************/\\

### Admin Route ###

# Books Controller
Route::get('/admin', 'AdminBooksController@index');

Route::get('/admin/add_book', 'AdminBooksController@addBookSite');

Route::post('/admin/add_book', 'AdminBooksController@addBook');

Route::get('/admin/all_books/{page}/{language}', 'AdminBooksController@allBooksSite');

Route::get('/admin/edit_book/{book_id}', 'AdminBooksController@editBookSite');

Route::post('/admin/edit_book', 'AdminBooksController@editBook');



