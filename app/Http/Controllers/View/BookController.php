<?php

namespace App\Http\Controllers\View;

use App\Entity\Product;
use App\Http\Controllers\Controller;

use App\Entity\Category;
use Illuminate\Http\Request;
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
}
