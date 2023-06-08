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

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::group(['prefix' => 'admin'], function() {

    Route::get('cardprice/create', 'Admin\CardPriceController@add');
    Route::post('cardprice/create', 'Admin\CardPriceController@create');
    Route::get('cardprice/edit', 'Admin\CardPriceController@edit');
    Route::post('cardprice/edit', 'Admin\CardPriceController@update');
    Route::get('carddetail', 'Admin\CardDetailController@index');


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


    Route::get('carddetail/create', 'Admin\CardDetailController@add');
    Route::post('carddetail/create', 'Admin\CardDetailController@create');
    Route::get('carddetail/edit', 'Admin\CardDetailController@edit');
    Route::post('carddetail/edit', 'Admin\CardDetailController@update');
    Route::get('carddetail', 'Admin\CardDetailController@index');
    Route::get('carddetail/price', 'Admin\CardDetailController@price');
    Route::get('carddetail/history', 'Admin\CardDetailController@history');
    Route::get('carddetail/historyAvg', 'Admin\CardDetailController@historyAvg');
    Route::get('carddetail/detail', 'Admin\CardDetailController@detail');
    Route::post('carddetail/import', 'Admin\CardDetailController@import');//laravel excel
    Route::get('carddetail/scrapingConditions', 'Admin\CardDetailController@scrapingConditions');
    Route::post('carddetail/scraping', 'Admin\CardDetailController@scraping');

    Route::get('carddetail/delete', 'Admin\CardDetailController@delete');

    Route::get('probability', 'Admin\ProbabilityController@calculation');

    Route::get('tournament/create', 'Admin\TournamentController@add');
    Route::post('tournament/create', 'Admin\TournamentController@create');

    Route::get('tournamentDeck/create', 'Admin\TournamentDeckController@add');
    Route::post('tournamentDeck/create', 'Admin\TournamentDeckController@create');

    Route::get('monstercarddetail/create', 'Admin\MonsterCardDetailController@add');
    Route::post('monstercarddetail/create', 'Admin\MonsterCardDetailController@create');
    Route::get('monstercarddetail/edit', 'Admin\MonsterCardDetailController@edit');
    Route::post('monstercarddetail/edit', 'Admin\MonsterCardDetailController@update');
    Route::get('monstercarddetail', 'Admin\MonsterCardDetailController@index');
    Route::get('monstercarddetail/delete', 'Admin\MonsterCardDetailController@delete');

    Route::get('monstercardclass/create', 'Admin\MonsterCardClassController@add');
    Route::post('monstercardclass/create', 'Admin\MonsterCardClassController@create');
    Route::get('monstercardclass/edit', 'Admin\MonsterCardClassController@edit');
    Route::post('monstercardclass/edit', 'Admin\MonsterCardClassController@update');
    Route::get('monstercardclass', 'Admin\MonsterCardClassController@index');
    Route::get('monstercardclass/delete', 'Admin\MonsterCardClassController@delete');

    Route::get('monsterclassmaster/create', 'Admin\MonsterClassMasterController@add');
    Route::post('monsterclassmaster/create', 'Admin\MonsterClassMasterController@create');
    Route::get('monsterclassmaster/edit', 'Admin\MonsterClassMasterController@edit');
    Route::post('monsterclassmaster/edit', 'Admin\MonsterClassMasterController@update');
    Route::get('monsterclassmaster', 'Admin\MonsterClassMasterController@index');
    Route::get('monsterclassmaster/delete', 'Admin\MonsterClassMasterController@delete');


    Route::get('tribemaster/create', 'Admin\TribeMasterController@add');
    Route::post('tribemaster/create', 'Admin\TribeMasterController@create');
    Route::get('tribemaster/edit', 'Admin\TribeMasterController@edit');
    Route::post('tribemaster/edit', 'Admin\TribeMasterController@update');
    Route::get('tribemaster', 'Admin\TribeMasterController@index');
    Route::get('tribemaster/delete', 'Admin\TribeMasterController@delete');

    Route::get('rarity/create', 'Admin\RarityController@add');
    Route::post('rarity/create', 'Admin\RarityController@create');

    Route::get('rarityconvert/create', 'Admin\RarityConvertController@add');
    Route::post('rarityconvert/create', 'Admin\RarityConvertController@create');

    /*
    Route::get('cardinfomation/create', 'Admin\CardInfomationController@add');
    Route::post('cardinfomation/create', 'Admin\CardInfomationController@create');
    Route::get('cardinfomation/edit', 'Admin\CardInfomationController@edit');
    Route::post('cardinfomation/edit', 'Admin\CardInfomationController@update');
    Route::get('magiccarddetail/create', 'Admin\MagicCardDetailController@add');
    Route::post('magiccarddetail/create', 'Admin\MagicCardDetailController@create');
    Route::get('magiccarddetail/edit', 'Admin\MagicCardDetailController@edit');
    Route::post('magiccarddetail/edit', 'Admin\MagicCardDetailController@update');
    Route::get('magiccarddetail', 'Admin\MagicCardDetailController@index');
    Route::get('magiccarddetail/delete', 'Admin\MagicCardDetailController@delete');
    Route::get('trapcarddetail/create', 'Admin\TrapCardDetailController@add');
    Route::post('trapcarddetail/create', 'Admin\TrapCardDetailController@create');
    Route::get('trapcarddetail/edit', 'Admin\TrapCardDetailController@edit');
    Route::post('trapcarddetail/edit', 'Admin\TrapCardDetailController@update');
    Route::get('trapcarddetail', 'Admin\TrapCardDetailController@index');
    Route::get('trapcarddetail/delete', 'Admin\TrapCardDetailController@delete');
    Route::get('pendulummonstercarddetail/create', 'Admin\PendulumMonsterCardDetailController@add');
    Route::post('pendulummonstercarddetail/create', 'Admin\PendulumMonsterCardDetailController@create');
    Route::get('pendulummonstercarddetail/edit', 'Admin\PendulumMonsterCardDetailController@edit');
    Route::post('pendulummonstercarddetail/edit', 'Admin\PendulumMonsterCardDetailController@update');
    Route::get('pendulummonstercarddetail', 'Admin\PendulumMonsterCardDetailController@index');
    Route::get('pendulummonstercarddetail/delete', 'Admin\PendulumMonsterCardDetailController@delete');
    Route::get('linkmonstercarddetail/create', 'Admin\LinkMonsterCardDetailController@add');
    Route::post('linkmonstercarddetail/create', 'Admin\LinkMonsterCardDetailController@create');
    Route::get('linkmonstercarddetail/edit', 'Admin\LinkMonsterCardDetailController@edit');
    Route::post('linkmonstercarddetail/edit', 'Admin\LinkMonsterCardDetailController@update');
    Route::get('linkmonstercarddetail', 'Admin\LinkMonsterCardDetailController@index');
    Route::get('linkmonstercarddetail/delete', 'Admin\LinkMonsterCardDetailController@delete');
    */
});
Route::get('/', 'CardPriceController@index');
