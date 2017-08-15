<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;

class ManageProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Product::all();
        return view('Product/index')->with('products',$all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Product/create')->with(['tree' => Category::getTree(), 'lvl' => 0]);
    }


    public function store(ProductRequest $request)
    {
        $f = $request->file('product')->store('/products');

        Product::create(['category_id'=> $request->parent_id,'title'=>$request->title, 'slug'=> str_slug($request->title, '-'),
            'image'=>$f, 'price'=>$request->price, 'description'=>$request->description]);

        return redirect()->route('product/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request): void
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currentProduct = Product::find($id);

        return view('Product/edit')->with(['tree' => Category::getTree(), 'lvl' => 0, 'currentProduct' => $currentProduct]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {

        $f = $request->file('product') ? $request->file('product')->store('products') : $request->image;

        Product::find($id)->update(['category_id'=> $request->parent_id,'title'=>$request->title,
            'slug'=> str_slug($request->title, '-'), 'image'=>$f, 'price'=>$request->price,
            'description'=>$request->description]);


        return redirect()->route('product/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('product/index');
    }
}
