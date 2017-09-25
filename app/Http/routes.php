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

Route::post('service/validate_code/create','Service\ValidateController@create');

Route::post('service/validate_phone/send','Service\ValidateController@sendSMS');