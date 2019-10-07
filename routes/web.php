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
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Web'],function(){
    Route::group(['prefix'=>'admin'],function(){
        Route::get('/','AdminController@index');
        Route::post('/store','AdminController@store');
    });
    Route::group(['prefix'=>'member'],function(){
        Route::get('/','MemberController@index');
        Route::get('/non_member','MemberController@non_member');
        Route::get('/create','MemberController@create');
        Route::get('/edit','MemberController@edit');
    });
    Route::group(['prefix'=>'sale'],function(){
        Route::get('/','SaleController@index');
        Route::get('sale_record','SaleController@sale_record');
    });
    Route::group(['prefix'=>'stock'],function(){
        Route::get('/','StockController@index');
        Route::get('stock_inventory','StockController@stock_inventory');
    });
});
