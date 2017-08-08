<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function parent(){
        return $this->belongsTo(self::class);
    }

    public function getProduct($path,$slug){

        $path = 'catalog/' .$path;

        $category = new Category();

        $navigationMenu = $category->searchPath($path);

        $product = Product::where('slug', $slug)->get()->first();

        $navigationMenu['title']->push(str_slug($product->title, '-'));

        $queries = collect(['product'=>$product, 'navigationMenu'=>$navigationMenu]);

        return $queries;
    }
}
