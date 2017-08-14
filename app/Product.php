<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id','title','slug', 'image', 'price', 'description'
    ];


    function parent() : BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    function category() : BelongsTo
    {
        return $this->belongsTo('App\Category');
    }

    function getAllProduct() : \Illuminate\Support\Collection
    {
        $all = $this->all();
        return $all;
    }

    function getCurrentProduct($id) : Product
    {
        return $this->find($id);
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


    public function createProduct($title,$image,$price,$description, $id) : void
    {
       $this->create(['category_id'=> $id,'title'=>$title, 'slug'=> str_slug($title, '-'),'image'=>$image, 'price'=>$price, 'description'=>$description]);
    }


    public function updateProduct($id,$title,$image,$price,$description,$category_id) : void
    {
        $this->find($id)->update(['category_id'=> $category_id,'title'=>$title,
            'slug'=> str_slug($title, '-'), 'image'=>$image, 'price'=>$price, 'description'=>$description]);
    }

    public function deleteProduct($id) : void
    {

        $this->find($id)->delete();

    }

}
