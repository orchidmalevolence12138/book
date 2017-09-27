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


Route::any('register','View\MemberController@toRegister');

Route::group(['prefix'=>'service'],function (){
    Route::get('validate_code/create','Service\ValidateController@create');

    Route::post('validate_phone/send','Service\ValidateController@sendSMS');

    Route::any('validate_email','Service\ValidateController@validateEmail');

    Route::post('register','Service\MemberController@register');

    Route::post('login','Service\MemberController@login');

    Route::get('category/parent_id/{parent_id}','Service\BookController@getCategoryByParentId');
});

Route::get('category','View\BookController@toCategory');
Route::get('product','View\BookController@toProduct');