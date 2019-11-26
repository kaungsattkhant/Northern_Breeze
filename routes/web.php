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
            Route::get('search_name','StaffController@search');
            Route::get('{id}/role_filter','StaffController@role_filter');
            Route::get('staff/{id}/role_filter','StaffController@role_filter');
            Route::post('/destroy',  'StaffController@destroy');
        });
        Route::group(['prefix'=>'member'],function(){
            Route::get('/','MemberController@index');
            Route::get('/non_member','MemberController@non_member');
            Route::get('/create','MemberController@create');
            Route::post('/store','MemberController@store');
            Route::get('{id}/edit','MemberController@edit');
            Route::post('update','MemberController@update');
            Route::get('{id}/member_type_filter','MemberController@member_type_filter');
            Route::get('member/{id}/member_type_filter','MemberController@member_type_filter');
            Route::get('search_name','MemberController@search');
            Route::post('destroy','MemberController@destroy');

        });
        Route::group(['prefix'=>'sale'],function(){
            Route::get('/','SaleController@index');
            Route::get('sale_record','SaleController@sale_record');
        });
        Route::group(['prefix'=>'stock'],function(){
            Route::get('/','StockController@index');
            Route::get('stock_inventory','StockController@stock_inventory');
        });
        Route::group(['prefix'=>'currency_group'],function(){
            Route::get('/','CurrencyGroupController@index');
            Route::get('/create','CurrencyGroupController@create');
            Route::post('store','CurrencyGroupController@store');
            Route::get('{id}/edit','CurrencyGroupController@edit');
            Route::patch('update','CurrencyGroupController@update');
            Route::post('destroy','CurrencyGroupController@destroy');


        });
        Route::group(['prefix'=>'daily_currency'],function(){
            Route::get('/','DailyCurrencyController@index');
            Route::get('/create','DailyCurrencyController@create');
            Route::post('store','DailyCurrencyController@store');
            Route::get('{id}/filter','DailyCurrencyController@daily_currency_filter');
            Route::post('/datefilter','DailyCurrencyController@daily_currency_datefilter');
            Route::get('/{group_id}/detail/{detail_id}','DailyCurrencyController@daily_detail');
        });
    });
});
Route::group(['namespace'=>'Web'],function(){
    Route::get('/','LoginController@login');
    Route::get('login',"LoginController@login");
    Route::post('login','LoginController@makeLogin');
    Route::match(['get','post'],'logout',"LoginController@logout");
});



Route::get('/non_member',function()
{
    return view('Member.non_member');
});
//
Route::get('/non_member2',function()
{
    return view('Member.non_member_2');
});

Route::get('/pos_member',function()
{
    return view('Member.pos_member');
});
//
Route::get('/pos_member2',function()
{
    return view('Member.pos_member_2');
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
//Route::get('/daily_currency',function()
//Route::get('/currency',function()
//{
//    return view('Currency.index');
//});
////Route::get('/daily_currency',function()
////{
////    return view('DailyCurrency.index');
////});
//Route::get('/daily_currency2',function()
//{
//    return view('DailyCurrency.index');
//});
Route::get('/daily_currency2',function()
{
    return view('DailyCurrency.index2');
});
//Route::get('/daily_currency3',function()
//{
//    return view('DailyCurrency.daily_currency');
//});
////Route::get('/daily_currency3',function()
////{
////    return view('DailyCurrency.daily_currency');
////});
Route::get('/test',function()
{
    return view('Currency.test');
});

