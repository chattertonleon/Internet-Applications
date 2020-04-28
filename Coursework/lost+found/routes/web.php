<?php

use Illuminate\Support\Facades\Route;

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

use App\Mail\ClaimAcceptedMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', 'ItemsController@index');

Auth::routes();

Route::resource('claims','ClaimsController');

Route::resource('items','ItemsController');

Route::resource('users','UserController');

Route::resource('images','ImagesController');

Route::resource('admin','AdminController');

Route::get('/home', 'ItemsController@index')->name('home');
