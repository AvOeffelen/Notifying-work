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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//make a push notification.
Route::get('/push','PushController@push')->name('push');
Route::get('/pushGuest','PushController@pushToGuest')->name('push.guest');

//store a push subscriber.
Route::post('/push','PushController@store');

Route::get('/get-started','GetStartedController@index')->name('get.started.index');


Route::get('/company','CompanyController@index')->name('my.company');



//TODO:: Add/create isOwner middleware
Route::group(['prefix' => 'axios/owner', 'namespace' => 'Axios\Owner'], function () {


    Route::put('company/{company}/update','CompanyController@update')->name('axios.company.update');

    Route::get('company/{company}/get/departments','DepartmentController@getAllDepartmentsForCompany')->name('axios.company.get.departments');
    Route::get('company/{company}/employees/get','CompanyController@getAllEmployees')->name('axios.company.get.employees');

    Route::delete('/department/{department}/delete','DepartmentController@delete')->name('axios.delete.department');
    Route::put('department/{department}/edit','DepartmentController@edit')->name('axios.edit.department');
    Route::post('department/create','DepartmentController@create')->name('axios.create.department');
});
