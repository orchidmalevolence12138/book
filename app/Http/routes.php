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

use App\Entity\Member;

Route::get('/','View\MemberController@toLogin');

Route::get('test',function (){
    $m = Member::all();

    return $m;
});

Route::any('login','View\MemberController@toLogin');



Route::group(['prefix'=>'service'],function  (){
    Route::get('validate_code/create','Service\ValidateController@create');

    Route::post('validate_phone/send','Service\ValidateController@sendSMS');

    Route::any('validate_email','Service\ValidateController@validateEmail');

    Route::post('register','Service\MemberController@register');

    Route::post('login','Service\MemberController@login');

    Route::get('category/parent_id/{parent_id}','Service\BookController@getCategoryByParentId');

    Route::get('cart/add/product_id/{product_id}','Service\CartController@addCart');

    Route::get('cart/delete','Service\CartController@deleteCart');

    Route::post('pay','Service\PayController@alipay');
    Route::post('pay/notify','Service\PayController@notify');
    Route::get('pay/call_back','Service\PayController@callback');
    Route::get('pay/wxpay','Service\PayController@wxPay');

});

Route::group(['middleware'=>'check.login'],function  (){
    Route::post('order_commit','View\OrderController@toOrderCommit');
    Route::get('order_list','View\OrderController@toOrderList');
});

Route::any('register','View\MemberController@toRegister');
Route::get('product','View\BookController@toProduct');
Route::get('pdt_content','View\BookController@toPdtContent');
Route::get('cart','View\CartController@toCart');
Route::get('pay',function(){
    return view('alipay');
});