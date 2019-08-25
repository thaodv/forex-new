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


Route::get('/','ForexController@index');
Route::post('/login','ForexController@login')->name('forex.login');
Route::get('/logout','ForexController@logout')->name('forex.logout');
Route::get('/dashboard','ForexController@dashboard')->name('forex.dashboard');
Route::get('/create','ForexController@create')->name('forex.create');
Route::post('/store','ForexController@store')->name('forex.store');
Route::get('/list','ForexController@list')->name('forex.list');
Route::get('/userList','ForexController@userList');

Route::get('/lead/list',"LeadController@list")->name('lead.list');
Route::get('/lead/new',"LeadController@create")->name('lead.new');
Route::post('/lead/store',"LeadController@store")->name('lead.store');

Route::get('/client/list',"ClientController@list")->name('client.list');
Route::get('/client/new',"ClientController@create")->name('client.new');
Route::post('/client/store',"ClientController@store")->name('client.store');
Route::get('/client/statistics',"ClientController@statistics")->name('client.statistics');