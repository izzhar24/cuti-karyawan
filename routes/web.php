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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');
    Route::resource('leaves', 'LeaveController');
    Route::resource('employees', 'EmployeeController');
    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::post('/profile/update', 'UserController@updateProfile')->name('users.profile.update');
});
