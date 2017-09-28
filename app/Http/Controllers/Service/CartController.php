<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M3Result;

class CartController extends Controller{
    //
    public function addCart(Request $request,$product_id){
        $m3_result = new M3Result();
        $id =  $product_id;//$request->get('product_id');
        $bk_cart = $request->cookie('bk_cart');
        //return $bk_cart;
        $bk_cart_arr = $bk_cart != null?explode(',',$bk_cart):array();

        $count = 1;

        foreach ($bk_cart_arr as &$value){
           $index = strpos($value,':');
           if (substr($value,0,$index) == $id){
                $count = ((int)substr($value,$index+1))+1;
                $value = $id.':'.$count;
                break;
           }
        }

        if($count == 1){
            array_push($bk_cart_arr,$id.':'.$count);
        }

        $m3_result->status = 0;
        $m3_result->message= "添加成功！";
       return response($m3_result->toJson())->withCookie('bk_cart',implode(',',$bk_cart_arr));
    }
}
