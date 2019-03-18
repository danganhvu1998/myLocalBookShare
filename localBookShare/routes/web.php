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
    return redirect("/all_books/1/all");
});

Auth::routes();

#Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact', 'HomeController@contactInformation')->name('contact');

### Users Route ###

# Users Controller
Route::get('my_info/edit', "UsersController@editInformationsSite");

Route::post('my_info/edit', "UsersController@editInformations");

Route::post('my_info/edit_password', "UsersController@editPassword");

# Books Controller
Route::get('all_books/{page}/{language}', 'BooksController@allBooksSite');

Route::get('detail_book/{book_id}', "BooksController@detailBookSite");

Route::get('about', "BooksController@aboutSite");

# Reservations Controller
Route::get('reserve/{book_id}', 'ReservationsController@reserveBook');

Route::get('cancel_reserve', 'ReservationsController@cancelReserveBook');

Route::get('reserving_info', "ReservationsController@reservingInfoSite");

Route::post('reserving/donation', "ReservationsController@reservingDonation");

# Reservation Controller

//************************ ### ************************/\\

### Admin Route ###

# Books Controller
Route::get('/admin', 'AdminBooksController@index');

Route::get('/admin/add_book', 'AdminBooksController@addBookSite');

Route::post('/admin/add_book', 'AdminBooksController@addBook');

Route::get('/admin/all_books/{page}/{language}', 'AdminBooksController@allBooksSite');

Route::get('/admin/edit_book/{book_id}', 'AdminBooksController@editBookSite');

Route::post('/admin/edit_book', 'AdminBooksController@editBook');

# Reservations Controller
Route::get('/admin/check_reservation_code', 'AdminReservationsController@checkReservationByCodeSite');

Route::get('/admin/check_reservation_code/{book_id}/{code}', 'AdminReservationsController@checkReservationSite');

Route::post('/admin/check_reservation_code/result', 'AdminReservationsController@checkReservationByCodeResult');

Route::post('/admin/check_reservation_code', 'AdminReservationsController@checkReservationByCode');

Route::get("/admin/over_due_reservations_delete", "AdminReservationsController@removeOverDueReservation");

# User Controller
Route::get("/admin/all_users", "AdminUsersController@allUsersSite");

Route::post("/admin/edit_users/reset_password", "AdminUsersController@resetPassword");
