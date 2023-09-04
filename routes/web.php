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

// Route::get('/', function () {
//     return view('main');
// })->name('home');

Route::get('/edit', function () {
        return view('appointment.edit');
    })->name('edit');

// home controller
Route::group(['namespace' => 'App\Http\Controllers',],function(){
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/appointment/search', 'HomeController@appointmentSearch')->name('appointment.search');

});

//appointment controller
Route::group(['namespace' => 'App\Http\Controllers',],function(){

    Route::get('/appointment','AppointmentController@index')->name('appointment.index');
    Route::post('/appointment/store','AppointmentController@store')->name('appointment.store');
    Route::get('/appointment/destroy/{id}','AppointmentController@destroy')->name('appointment.destroy');

    Route::post('/appointment/session','AppointmentController@sessionForm')->name('appointment.session');
    Route::get('/remove/session/{id}','AppointmentController@sessionRemove')->name('remove.session');

});

//doctor controller
Route::group(['namespace' => 'App\Http\Controllers',],function(){

    Route::get('/doctor/list','DoctorController@index')->name('doctor.index');
    Route::post('/store/doctor','DoctorController@store')->name('doctor.store');
    Route::get('/doctor/delete/{id}','DoctorController@delete')->name('doctor.delete');
    Route::get('/doctor/edit/{id}','DoctorController@edit')->name('doctor.edit');
    Route::post('/update/doctor','DoctorController@update')->name('doctor.update');

    Route::get('/doctor/get/{id}','DoctorController@getDoctor');
    Route::get('/fee/get/{id}','DoctorController@getDoctorFee');


});

