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

// Pre-Login Page
Route::get('/', 'PagesController@showWelcome');

// Post-Login Page
Route::get('home', 'PagesController@showHome')->middleware('auth');

// Login Page
Route::get('login', 'LoginController@index')->name('login')->middleware('guest');
Route::post('login', 'LoginController@authenticate')->middleware('guest');
Route::post('logout', 'LoginController@logout')->middleware('auth');

// Register Page
Route::get('register', 'RegisterController@index')->middleware('guest');
Route::post('register', 'RegisterController@store')->middleware('guest');

// Task Page
Route::get('task', 'TasksController@index')->middleware('auth');
Route::post('task', 'TasksController@store')->middleware('auth');
Route::delete('task/{id}', 'TasksController@destroy')->middleware('auth');
Route::get('task/{id}/edit', 'TasksController@edit')->middleware('auth');
Route::put('task/{id}/mark', 'TasksController@mark')->middleware('auth');
Route::put('task/{id}/update', 'TasksController@update')->middleware('auth');

// Contact Page
Route::get('contact', 'ContactController@index');

// Appointment Page
Route::get('appointment', 'AppointmentController@index');
