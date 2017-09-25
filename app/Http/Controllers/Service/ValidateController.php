<?php

namespace App\Http\Controllers\Service;


use Illuminate\Http\Request;
use App\Models\M3Result;
use App\Tool\Validate\ValidateCode;
use App\Http\Controllers\Controller;
use App\Tool\SMS\SendTemplateSMS;
use App\Entity\TempPhone;
use Validator;

class ValidateController extends Controller
{

    public function create(){
        $validateCode = new ValidateCode;

        return $validateCode->doimg();
    }

    public function sendSMS(Request $request){
        $m3result = new M3Result();

        $phone = $request->get('phone');
        if($phone == '') {
            $m3result->status = 1;
            $m3result->message = '手机号不能为空';
            return $m3result->toJson();
        }
        if(strlen($phone) != 11 || $phone[0] != '1') {
            $m3result->status = 2;
            $m3result->message = '手机格式不正确';
            return $m3result->toJson();
        }


        $sendTemplateSMS = new SendTemplateSMS;
        $charset = '1234567890';//随机因子
        $code = '';
        $_len = strlen($charset) - 1;
        for ($i = 0;$i < 6;++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }

        $m3_result =  $sendTemplateSMS->sendTemplateSMS($phone,array($code,'60'),1);
        if($m3_result->status == 0){
            $tempPhone = new TempPhone;
            $tempPhone->phone = $phone;
            $tempPhone->code = $code;
            $tempPhone->deadline = date('Y-m-d H-i-s',time()+ 60*60);
            //$tempPhone ->fill($data);
            $tempPhone ->save();
        }
        return $m3_result->toJson();
    }
}
