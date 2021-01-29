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

Route::group(['prefix' => 'admin'], function() {
    Route::get('cardinfomation/create', 'Admin\CardInfomationController@add');
    Route::post('cardinfomation/create', 'Admin\CardInfomationController@create');
    Route::get('cardinfomation/edit', 'Admin\CardInfomationController@edit');
    Route::post('cardinfomation/edit', 'Admin\CardInfomationController@update');


    Route::get('cardprice/create', 'Admin\CardPriceController@add');
    Route::post('cardprice/create', 'Admin\CardPriceController@create');
    Route::get('cardprice/edit', 'Admin\CardPriceController@edit');
    Route::post('cardprice/edit', 'Admin\CardPriceController@update');


    Route::get('cardshop/create', 'Admin\CardShopController@add');
    Route::post('cardshop/create', 'Admin\CardShopController@create');
    Route::get('cardshop/edit', 'Admin\CardShopController@edit');
    Route::post('cardshop/edit', 'Admin\CardShopController@update');
    Route::get('cardshop', 'Admin\CardShopController@index');
    Route::get('cardshop/delete', 'Admin\CardShopController@delete');

    Route::get('recordingcard/create', 'Admin\RecordingCardController@add');
    Route::post('recordingcard/create', 'Admin\RecordingCardController@create');
    Route::get('recordingcard/edit', 'Admin\RecordingCardController@edit');
    Route::post('recordingcard/edit', 'Admin\RecordingCardController@update');
    Route::get('recordingcard', 'Admin\RecordingCardController@index');
    Route::get('recordingcard/delete', 'Admin\RecordingCardController@delete');

    Route::get('recordingpack/create', 'Admin\RecordingPackController@add');
    Route::post('recordingpack/create', 'Admin\RecordingPackController@create');
    Route::get('recordingpack/edit', 'Admin\RecordingPackController@edit');
    Route::post('recordingpack/edit', 'Admin\RecordingPackController@update');
    Route::get('recordingpack', 'Admin\RecordingPackController@index');
    Route::get('recordingpack/delete', 'Admin\RecordingPackController@delete');



});
Route::get('/', 'CardPriceController@index');
