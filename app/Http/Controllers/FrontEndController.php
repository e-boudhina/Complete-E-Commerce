<?php

namespace App\Http\Controllers;

use App\Models\Product_M;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $projects = Product_M::orderBy('created_at','desc')->paginate(3);
        return view('index')->with('products', $projects);
    }
    public function singleProduct(Product_M $product_M)
    {
//        dd($product_M);
        return view('single')->with('product',$product_M);
    }
}
