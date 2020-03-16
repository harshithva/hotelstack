<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')
        ->name('home');

Route::get('/admin/homepage/{id}/edit', 'HomeController@edit')->name('homepageedit')->middleware('auth');
Route::put('/admin/homepage/{id}', 'HomeController@update')->name('homepageupdate')->middleware('auth');

Route::resource('/admin', 'DashboardController');

Route::resource('/admin/hotel/floors', 'FloorController');
Route::resource('/admin/hotel/room_types', 'RoomTypeController');
Route::resource('/admin/hotel/rooms', 'RoomController');


Auth::routes();
