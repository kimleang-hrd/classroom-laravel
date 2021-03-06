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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/home');
});

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('class')->group(function () {
        Route::get('/{id}', 'Classroom\ClassroomController@class');
        Route::post('/create', 'Classroom\ClassroomController@createClass');
        Route::post('/join', 'Classroom\ClassroomController@joinClass');
        Route::get('/confirm/{studentId}/{classId}', 'Classroom\ClassroomController@confirmStudents');
        Route::get('/reject/{studentId}/{classId}', 'Classroom\ClassroomController@rejectStudents');
        Route::get('/delete/{id}', 'Classroom\ClassroomController@deleteClass');
        Route::get('/leave/{id}', 'Classroom\ClassroomController@leaveClass');
        Route::post('/update/{id}', 'Classroom\ClassroomController@updateClass');
    });

    Route::prefix('people')->group(function () {
        Route::get('/{id}', 'PeopleController@index');
    });

    Route::prefix('classwork')->group(function () {
        Route::get('/{id}', 'Classroom\ClassworkController@index');
        Route::post('/create', 'Classroom\ClassworkController@create');
        Route::post('/submit', 'Classroom\ClassworkController@submit');
    });

});