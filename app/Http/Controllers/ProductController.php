<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(Request $request){
   $product = new Product();
   $currentProduct = $product->getProduct($request->path, $request->slug);

        return view('Product/product')->with(['paths'=> $currentProduct['navigationMenu']['paths'],
            'link'=> $currentProduct['navigationMenu']['title'],
            'product'=>$currentProduct['product'] ]);

    }
}
