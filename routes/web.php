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
Route::get('/pushUser','PushController@push')->name('push');
Route::get('/pushGuest','PushController@pushToGuest')->name('push.guest');

//store a push subscriber.
Route::post('/push','PushController@store');

Route::get('/get-started','GetStartedController@index')->name('get.started.index');


Route::get('/company','CompanyController@index')->name('my.company');

Route::get('/employees','EmployeeController@index')->name('employees');

Route::get('/notifications','NotificationController@index')->name('notifications');
Route::get('/notifications/push','PushNotificationController@index')->name('notification.push');



//TODO:: Add/create isOwner middleware
Route::group(['prefix' => 'axios/owner', 'namespace' => 'Axios\Owner'], function () {


    Route::put('company/{company}/update','CompanyController@update')->name('axios.company.update');

    Route::get('company/{company}/get/departments','DepartmentController@getAllDepartmentsForCompany')->name('axios.company.get.departments');
    Route::get('company/{company}/employees/get','CompanyController@getAllEmployees')->name('axios.company.get.employees');

    Route::delete('/department/{department}/delete','DepartmentController@delete')->name('axios.delete.department');
    Route::delete('/company/{company}/departments/delete','DepartmentController@massDeleteDepartment')->name('axios.mass.delete.department');
    Route::put('department/{department}/edit','DepartmentController@edit')->name('axios.edit.department');
    Route::post('department/create','DepartmentController@create')->name('axios.create.department');


    Route::delete('/company/{company}/department/{department}/employees/detach','DepartmentController@detachEmployeeFromDepartment')->name('axios.department.detach.employees');
    Route::post('/company/{company}/department/{department}/employees/attach','DepartmentController@attachEmployeesToDepartment')->name('axios.department.attach.employees');


    Route::get('employees/get','EmployeeController@getEmployees')->name('axios.get.employees');
    Route::get('employees/unfiltered/get','EmployeeController@getUnfilteredEmployees')->name('axios.get.unfiltered.employees');

    Route::get('/departments/get','DepartmentController@getDepartments')->name('axios.departments.get');
});

Route::group(['prefix' => 'axios/owner/notifications', 'namespace' => 'Axios\Owner'], function () {

    Route::post('/push/send','PushNotificationController@sendNotification')->name('axios.notification.push.send');

});

Route::group(['prefix' => 'axios/notifications', 'namespace' => 'Axios'], function () {

    Route::get('push/get','PushNotificationController@getNotificationsForUser')->name('axios.notification.get');
    Route::post('push/{notification}/mark-as-read','PushNotificationController@markNotificationAsRead')->name('axios.notification.read');

});

Route::group(['prefix' => 'axios/home', 'namespace' => 'Axios'], function () {

    Route::get('employees/get','EmployeeController@getEmployees')->name('axios.get.employees');

});
