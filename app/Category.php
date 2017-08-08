<?php

namespace App;

use App\Http\Controllers\BranchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\Collection;

class Category extends Model
{
    use NodeTrait;

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    protected $fillable = [
        'title', 'slug', 'path',
    ];

    public function getTree() : Collection
    {
        $tree = Category::get()->toTree();

        return $tree;
    }

    public function createBranch($parent_id, $title){
        $parent = Category::findOrFail($parent_id);
        $slug = str_slug($title, '-');

        $new_elem = new Category(['title' => $title, 'slug' => $slug, 'path' => $parent->path . '/'. $slug]);

        $new_elem->appendToNode($parent)->save();
    }

    public function editBranch($id)
    {
        $category =  Category::findOrFail($id);

        $tree = Category::get()->toTree();

        $categoryAndTree = collect(['category' => $category, 'tree' => $tree]);

        return $categoryAndTree;
    }


    public function updateBranch($child_id, $parent_id, $title, $root = 'catalog'){

        $node = Category::findOrFail($child_id);
        $parent = Category::findOrFail($parent_id);

        $node->title = $title;
        $node->slug = str_slug($title,'-');

        $node->appendToNode($parent)->save();

        $path = $root;
        $slugs = $node->ancestors()->pluck('slug')->toArray();

        foreach ($slugs as $value) {
            $path .=  '/'.$value;
        }

        $node->path = $path . '/' . $node->slug;
        $node->save();

        Category::pathDescendants($node, $node->path);

    }


    public function searchPath($path){

        $category = Category::where('path', '=', $path)->first();

        $navigationMenu = Category::getNavigationMenu($category);

        return $navigationMenu;
    }

    public function getBranch($part_path){

        $path = 'catalog/' . $part_path;

        $category = Category::where('path',$path)->first();

        $navigationMenu = Category::getNavigationMenu($category);


      //  $products = DB::select("select * from products where category_id = $category->id");

        $products = Product::where('category_id', $category->id)->get();

        Category::descendants($category, $products);

        $queries = collect(['products'=>$products, 'navigationMenu'=>$navigationMenu]);

        return $queries;

    }


    private function pathDescendants($parentNode, $path){

        $node = null;
        foreach ($parentNode['children'] as $value){

            $value->path = $path . '/' . $value->slug;
            $value->save();

            if(isset($value['children'][0])){
                Category::pathDescendants($value, $value->path);
            }
        }

    }

    public function getNavigationMenu($category)
    {
        $title = $category->ancestors()->pluck('title');
        $paths = $category->ancestors()->pluck('path');

        $paths->push($category->path);
        $title->push($category->title);

        $navigationMenu = collect(['title'=>$title, 'paths'=>$paths]);

        return $navigationMenu;
    }


        private function descendants($parentNode, &$products)
        {

            $node = null;
            foreach ($parentNode['children'] as $node) {
                $results = Product::where('category_id', $node->id);
                foreach ($results as $res){
                    array_push($products, $res);
                }

                Category::descendants($node, $products);

            }
        }




}
