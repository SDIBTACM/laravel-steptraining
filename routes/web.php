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

// Authentication Routes...
Route::get('/login', 'Auth\LoginController@showLoginFrom');
Route::post('/login', 'Auth\LoginController@login') ->name('login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@show');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// Show
Route::get('/', 'HomeController@index')->name('home');
Route::get('/plan/{plan}', 'PlanController@show')->name('plan.detailed');
Route::get('/plan', 'PlanController@list')->name('plan.list');

// Admin
Route::prefix('admin/')->middleware(['auth'])->group(function () {
    Route::resource('plan', 'Admin\PlanController');
    Route::resource('student', 'Admin\StudentController');
    Route::resource('problem', 'Admin\ProblemController');
});