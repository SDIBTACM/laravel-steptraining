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
Route::prefix('/admin/')->namespace('Admin')->middleware(['auth'])->name('admin.')->group(function () {

    // Plan Manage
    Route::resource('plan', 'PlanController')->except(['create', 'edit', 'show']);
    Route::get('/plan/{plan}/student/', 'PlanManagerController@student')->name('plan.student_form');
    Route::get('/plan/{plan}/problem/', 'PlanManagerController@problem')->name('plan.problem_form');
    Route::post('/plan/{plan}/student/', 'PlanManagerController@addStudent')->name('plan.student.add');
    Route::post('/plan/{plan}/problem/', 'PlanManagerController@addProblem')->name('plan.problem.add');
    Route::delete('/plan/{plan}/student/', 'PlanManagerController@deleteStudent')->name('plan.student.delete');
    Route::delete('/plan/{plan}/problem/', 'PlanManagerController@deleteProblem')->name('plan.problem.delete');

    // Student Manage
    Route::resource('student', 'StudentController')->except(['create', 'edit', 'show']);
    Route::get('/student/{student}/account/', 'StudentAccountController@index')->name('student.account_form');
    Route::post('/student/{student}/account/', 'StudentAccountController@update')->name('student.account_update');

    // Problem Manage
    Route::resource('problem', 'ProblemController')->except(['create', 'edit', 'show']);

    // User Manage
    Route::resource('user', 'UserController');

    //
    Route::resource('category', 'CategoryController')->except(['create', 'edit', 'show']);

    Route::get('/', function () {
        return redirect()->route('admin.plan.index');
    })->name('home');
    //Route::get('logs', 'LogController@index')->name('logs');
});

Route::get('/teapot', function () {
    \App\Log::info('some one found a teapot');
    abort(418);
})->name('teapot');

Route::post('/analytics', 'AnalyticsController@index')->name('analytics');