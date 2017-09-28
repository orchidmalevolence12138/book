<?php

namespace App\Http\Controllers\View;

use App\Entity\PdtContent;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use Illuminate\Http\Request;
use App\Entity\PdtImages;
use Log;
class BookController extends Controller{
    //
    public function toCategory(){

        Log::info('书籍类别');
        $categorys = Category::whereNull('parent_id')->get();

        return view('category')->with('categorys',$categorys);
    }

    public function toProduct(Request $request){
        $products = Product::where('category_id',$request->get('category_id'))->get();

        return view('product')->with('products',$products);
    }

    public function toPdtContent(Request $request){
        $id = $request->get('product_id');
        $product = Product::find($id);
        $pdt_content = PdtContent::where('product_id',$id)->first();
        $pdt_images =  PdtImages::where('product_id',$id)->get();

        $bk_cart = $request->cookie('bk_cart');
        //return $bk_cart;
        $bk_cart_arr = $bk_cart != null?explode(',',$bk_cart):array();

        $count = 0;

        foreach ($bk_cart_arr as $value){
            $index = strpos($value,':');
            if (substr($value,0,$index) == $id){
                $count = ((int)substr($value,$index+1));
                break;
            }
        }




        return view('pdt_content')->with('product',$product)
                                       ->with('pdt_content',$pdt_content)
                                       ->with('pdt_images',$pdt_images)
                                        ->with('count',$count);
    }
}
