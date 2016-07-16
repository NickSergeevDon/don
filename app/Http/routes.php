<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'admin'], function() {

    Route::get('/', function()
    {
         return view('admin.main');
    });
    
    Route::get('/results','ResultsController@index');
    Route::get('/varieties/{id}','VarietiesController@index');
    Route::get('/varieties/create/{id}','VarietiesController@create');
    Route::get('/users/','UsersController@index');
    Route::get('/users/{id}/edit','UsersController@edit');
    Route::delete('/users/{id}/destroy','UsersController@destroy');
    Route::put('/users/{id}/update','UsersController@update');
    Route::get('exportClients', 'ClientController@export'); // экспортируем клиентов из старой базы
    
    
    Route::resource('groups','ProductGroupsController');
    Route::resource('products','ProductsController');
    Route::resource('varieties','VarietiesController');
    Route::resource('outlets','OutletsController');
    Route::resource('atoms','AtomsController');
});

Route::group(['prefix'=>'desk'], function() {

    Route::get('/', 'OrderController@index');
    
    Route::get('select/{id}', 'OrderController@select'); // Выбор продукта для показа его вариантов 
    Route::get('add/{id}', 'OrderController@add');   // Добавление варианта продукта в корзину 
    Route::get('remove/{id}', 'OrderController@remove'); // Удаление выбранного варианта 
    Route::get('submitOrder', 'OrderController@submitOrder'); // Сохранение заказа 
    Route::post('setDiscont', 'OrderController@setDiscont'); // Добавление скидки
    Route::post('setClient', 'OrderController@setClient'); // Добавление клиента
    Route::get('StartOrFinish', 'SessionController@toStartOrFinish'); // начало работы бариста
    Route::post('startSession', 'SessionController@startSession'); // начать сессию бариста
    Route::post('finishSession', 'SessionController@finishSession'); //закончить сессию бариста

    Route::resource('clients','ClientController');
    
});


Route::get('/', function () {
    return view('home');
});

/*
Route::get('/desk', 'DeskController@index');
Route::get('/desk/select/{id}', 'DeskController@select');
Route::get('/desk/add/{id}', 'DeskController@add');
Route::get('/desk/remove/{id}', 'DeskController@remove');
Route::post('/desk/discont', 'DeskController@discont');
Route::post('/desk/client', 'DeskController@clientfind');
Route::get('/newclients', 'ClientController@index');
Route::delete('/client/{id}/destroy','ClientController@destroy'); */

Route::auth();

Route::get('/home', 'HomeController@index');
