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

Route::group(['middleware'=>['staffCheck']],function() {
    Route::group(['namespace'=>'Web'],function(){
        Route::group(['prefix'=>'admin'],function(){
            Route::get('/','AdminController@index');
            Route::post('/store','AdminController@store');
        });
        Route::group(['prefix'=>'staff'],function (){
            Route::get('/','StaffController@index');
            Route::post('/store','StaffController@store');
            Route::get('{id}/edit','StaffController@edit');
            Route::post('update','StaffController@update');

        });
        Route::group(['prefix'=>'member'],function(){
            Route::get('/','MemberController@index');
            Route::get('/non_member','MemberController@non_member');
            Route::get('/create','MemberController@create');
            Route::post('/store','MemberController@store');
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
});
Route::group(['namespace'=>'Web'],function(){
    Route::get('login',"LoginController@login");
    Route::post('login','LoginController@makeLogin');
    Route::match(['get','post'],'logout',"LoginController@logout");
});


Route::get('/non_member',function()
{
    return view('Member.non_member');
});

Route::get('/pos_member',function()
{
    return view('Member.pos_member');
});

Route::get('/stock',function()
{
    return view('Stock.stock_inventory');
});

Route::get('/create_stock',function()
{
    return view('Stock.add');
});

Route::get('/transfer_stock',function()
{
    return view('Stock.transfer');
});
Route::get('/currency',function()
{
    return view('Currency.index');
});
Route::get('/daily_currency',function()
{
    return view('DailyCurrency.index');
});
Route::get('/daily_currency2',function()
{
    return view('DailyCurrency.index2');
});

