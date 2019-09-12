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
Route::get('/activity-log','ForexController@activityLogs')->name('forex.logs');
Route::get('/assign-trader',"ForexController@assignTrader")->name('forex.assign-trader');
Route::post('/save-trader',"ForexController@saveTrader");
Route::post('/tradername',"ForexController@traderName");
Route::get('/liquidity',"ForexController@setLiquidity")->name('forex.liquidity');
Route::post('/saveliquidity',"ForexController@saveLiquidity")->name('forex.saveliquidity');


Route::get('/lead/list',"LeadController@list")->name('lead.list');
Route::get('/lead/new',"LeadController@create")->name('lead.new');
Route::get('/lead/appointment',"LeadController@appointment")->name('lead.appointment');
Route::post('/lead/store',"LeadController@store")->name('lead.store');
Route::post('/lead/callsummary',"LeadController@callSummary")->name('lead.callsummary');
Route::get('/lead/onboard',"LeadController@onboardLead")->name('lead.onboard');
Route::get('/lead/signature',"LeadController@signature")->name('lead.signature');
Route::post('/lead/savesignature',"LeadController@saveSignature")->name('lead.savesignature');
Route::get('/lead/for-approval',"LeadController@forApproval")->name('lead.approval');


Route::get('/client/list',"ClientController@list")->name('client.list');
Route::get('/client/new',"ClientController@create")->name('client.new');
Route::post('/client/savesignature',"ClientController@saveSignature");
Route::post('/client/getsignature',"ClientController@getSignature");

Route::post('/client/store',"ClientController@store")->name('client.store');
Route::post('/client/update',"ClientController@update");
Route::get('/client/statistics',"ClientController@statistics")->name('client.statistics');
Route::get('/client/profile/{id}',"ClientController@profile")->name('client.profile');
Route::post('/client/name',"ClientController@clientName");
Route::get('/client/onboard',"ClientController@onboard")->name('client.onboard');
Route::get('/client/onboard-statistics',"ClientController@onboardStatistics")->name('client.onboardstats');
Route::post('/client/listName',"ClientController@faoClientList");
Route::get('/client/atp',"ClientController@atp")->name('client.atp');
Route::post('/client/atp-store',"ClientController@saveAtpForm")->name('client.saveatp');


//  Route::get('/order/list',"BookOrderController@list")->name('order.list');
//  Route::get('/order/create',"BookOrderController@create")->name('order.create');
//  Route::get('/order/store',"BookOrderController@store")->name('order.store');

Route::get('/signature/{signee}',"LeadController@signatureWindow");

Route::get('/trader/list',"ClientController@traderList")->name('trader.list');
Route::get('/trader/orders',"OrderController@traderOrderList")->name('trader.orders');
Route::get('/trader/bookorder/',"OrderController@traderOrderCreate")->name('trader.create');
Route::post('/order/store',"OrderController@store")->name('order.store');
Route::get('/order/atp',"ClientController@atp")->name('order.atp');



Route::get('/prospect/list',"ProspectLeadController@index")->name('prospect.list');
Route::get('/prospect/new',"ProspectLeadController@create")->name('prospect.new');
Route::post('/prospect/store',"ProspectLeadController@store")->name('prospect.store');
Route::post('/prospect/outcome-of-call',"ProspectLeadController@callsummary")->name('prospect.callsummary');
Route::get('/prospect/onboard',"ProspectLeadController@onboard")->name('prospect.onboard');
