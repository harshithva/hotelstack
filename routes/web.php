<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ReservationMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applicaion. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/email', function() {
return new ReservationMail();
});
Route::get('/', 'HomeController@index')
        ->name('home');

Route::get('/admin/homepage/{id}/edit', 'HomeController@edit')->name('homepageedit')->middleware('auth');
Route::put('/admin/homepage/{id}', 'HomeController@update')->name('homepageupdate')->middleware('auth');

Route::resource('/admin/hotel/reviews', 'ReviewController');

Route::resource('/admin', 'DashboardController');

Route::resource('/admin/hotel/floors', 'FloorController');
Route::resource('/admin/hotel/room_types', 'RoomTypeController');
Route::resource('/admin/hotel/rooms', 'RoomController');
Route::resource('/admin/hotel/paid_services', 'PaidServiceController');
Route::resource('/admin/hotel/tax', 'TaxController');

Route::resource('/admin/hotel/guests', 'GuestController');
Route::post('/admin/hotel/guests/search', 'GuestController@searchGuest')->name('guests.search');

Route::resource('/admin/hotel/reservations', 'ReservationController');
Route::get('/admin/hotel/reservations/make/select_guests', 'ReservationController@selectGuest')->name('reservations.guest');
Route::get('/admin/hotel/reservations/make/{guest}/select_room_type', 'ReservationController@selectRoomDetails')->name('reservations.room_details');
Route::post('/admin/hotel/reservations/make/{guest}/select_room_type/room', 'ReservationController@getRooms')->name('reservations.rooms');
Route::post('/admin/hotel/reservations/make/{guest}/select_room_type/room/select', 'ReservationController@calculateSum')->name('reservations.rooms.select');
Route::post('/admin/hotel/reservations/make/checkin/{reservation_id}', 'ReservationController@checkIn')->name('reservations.checkin');
Route::post('/admin/hotel/reservations/make/mark_as_no_show/{reservation_id}', 'ReservationController@markAsNoShow')->name('reservations.mark_noshow');

Route::resource('/admin/hotel/checkin', 'CheckInController');
Route::get('/admin/hotel/checkin/make/select_guests', 'CheckInController@selectGuest')->name('check_in.guest');
Route::get('/admin/hotel/checkin/make/{guest}/select_room_type', 'CheckInController@selectRoomDetails')->name('check_in.room_details');
Route::post('/admin/hotel/checkin/make/{guest}/select_room_type/room', 'CheckInController@getRooms')->name('check_in.rooms');
Route::post('/admin/hotel/checkin/make/{guest}/select_room_type/room/select', 'CheckInController@calculateSum')->name('check_in.rooms.select');

// check out
Route::get('/admin/hotel/checkin/make/check_out/{id}', 'CheckInController@check_out')->name('check_out');

// invoice
Route::post('/admin/hotel/checkin/generate/invoice', 'InvoiceController@store')->name('check_in.generate.invoice');
Route::get('/admin/hotel/checkin/invoice/{reservation_id}/view', 'InvoiceController@show')->name('invoice.view');
Route::patch('/admin/hotel/checkin/invoice/update/{reservation_id}', 'InvoiceController@update')->name('invoice.update');

Route::resource('/admin/hotel/reservation/payment', 'PaymentController');
Route::resource('/admin/hotel/reservation/service', 'ServiceController');


Route::resource('/admin/hotel/expenses', 'ExpenseController');

// reports
Route::get('/admin/hotel/reports', 'ReportController@index')->name('reports.index');

Route::delete('/admin/hotel/reservation/reservation_room/{room}', 'RerservationRoomController@destroy')->name('reservation.room.delete');
Route::post('/admin/hotel/reservation/reservation_room/add', 'RerservationRoomController@store')->name('reservation.room.store');



Auth::routes();
