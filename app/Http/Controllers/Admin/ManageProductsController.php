<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ManageProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $product = new Product();
        return view('Product/index')->with('products', $product->getAllProduct());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {
        return view('Product/create')->with(['tree'=> Category::getTree(), 'lvl'=>0]);
    }


    public function store(Request $request) : Redirect
    {
       $product = new Product();
       $f =  $request->file('product')->store('/products');
      $product->createProduct($request->title,$f,$request->price,$request->description,$request->parent_id);

        return redirect()->route('product/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) : void
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)   : View
    {
        $product = new Product();
        $currentProduct = $product->getCurrentProduct($id);

        return view('Product/edit')->with(['tree'=> Category::getTree(), 'lvl'=>0, 'currentProduct' => $currentProduct]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) : Redirect
    {
        $product = new Product();

        $f =  $request->file('product') ? $request->file('product')->store('products') : $request->image;
        $product->updateProduct($id,$request->title, $f, $request->price, $request->description, $request->parent_id);

        return redirect()->route('product/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) : Redirect
    {
        $product = new Product();
        $product->deleteProduct($id);

        return redirect()->route('product/index');
    }
}
