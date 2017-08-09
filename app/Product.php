<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    function parent(){
        return $this->belongsTo(self::class);
    }

    function category(){
        return $this->belongsTo('App\Category');
    }

    public function getProduct($path,$slug): \Illuminate\Support\Collection
    {
        $path = 'catalog/' .$path;

        $category = new Category();

        $navigationMenu = $category->searchPath($path);

        $product = $this->where('slug', $slug)->get()->first();

        $navigationMenu['title']->push(str_slug($product->title, '-'));

        $queries = collect(['product'=>$product, 'navigationMenu'=>$navigationMenu]);

        return $queries;
    }
}
