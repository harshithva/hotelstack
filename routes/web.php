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

Route::resource('/admin/hotel/checkin', 'CheckInController');
Route::get('/admin/hotel/checkin/make/select_guests', 'CheckInController@selectGuest')->name('check_in.guest');
Route::get('/admin/hotel/checkin/make/{guest}/select_room_type', 'CheckInController@selectRoomDetails')->name('check_in.room_details');
Route::post('/admin/hotel/checkin/make/{guest}/select_room_type/room', 'CheckInController@getRooms')->name('check_in.rooms');
Route::post('/admin/hotel/checkin/make/{guest}/select_room_type/room/select', 'CheckInController@calculateSum')->name('check_in.rooms.select');
// API
// Route::resource('/api/v1/guests', 'GuestApiController');

Auth::routes();
