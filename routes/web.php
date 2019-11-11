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

Auth::routes(); // Register y Login

/**
 * Enviar Email
 */
Route::get('contact', 'SendEmailController@index')->name('contact');
Route::post('contact-sendemail', 'SendEmailController@sendEmail')->name('contact-sendemail');

/**
 * Crud con axios y Vuejs
 */
Route::get('show-crud', 'CrudController@index')->name('show-crud');
Route::post('crud-vuejs-axios', 'CrudController@storeItem');
Route::get('crud-vuejs-axios', 'CrudController@readItems');
Route::get('crud-vuejs-axios-update/{id}', 'CrudController@readItemsUpdate');
Route::put('crud-vuejs-axios/{id}', 'CrudController@updateItems');
Route::delete('crud-vuejs-axios/{id}', 'CrudController@deleteItems');

/**
 * Mostrar Consulta con Vue
 */
Route::get('new-show-crud', 'CrudController@getProffesion')->name('new-show-crud');

/**
 * OpenPay
 */
Route::get('openpay', 'OpenPayController@index')->name('openpay');


