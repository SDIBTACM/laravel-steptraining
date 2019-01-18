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
Route::get('/login', 'Auth\LoginController@showLoginFrom')->name('login_page');
Route::post('/login', 'Auth\LoginController@login') ->name('login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');

Route::get('/register', 'Auth\RegisterController@show')->name('register_page');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// Show
Route::get('/', 'HomeController@index')->name('home');
Route::get('/plan/{plan}', 'PlanController@show')->name('plan.show');
Route::get('/plan', 'PlanController@list')->name('plan.list');

// Admin
Route::prefix('admin/')->namespace('Admin')->middleware(['auth'])->name('admin.')->group(function () {

    Route::resource('plan', 'PlanController');
    Route::resource('student', 'StudentController');
    Route::resource('problem', 'ProblemController')->except(['update', 'edit']);
    Route::resource('user', 'UserController');
    Route::resource('category', 'CategoryController');
    Route::get('/', 'HomeController@index')->name('home');
});