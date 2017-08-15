<?php

namespace App;
use App\Http\Controllers\BranchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model
{
    use NodeTrait;

    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function selectedProducts()  : HasMany
    {
        return $this->hasMany('App\Product', 'category_id','id');
    }


    protected $fillable = [
        'title', 'slug', 'path',
    ];

    public static function getTree() : \Illuminate\Support\Collection
    {
        $tree = Category::get()->toTree();
        return $tree;
    }

    public function createBranch($parent_id, $title) : void
    {
        $parent = $this->findOrFail($parent_id);
        $slug = str_slug($title, '-');

        $new_elem = new Category(['title' => $title, 'slug' => $slug, 'path' => $parent->path . '/'. $slug]);

        $new_elem->appendToNode($parent)->save();
    }

    public function editBranch($id) : \Illuminate\Support\Collection
    {
        $category =  $this->findOrFail($id);

        $tree = $this->get()->toTree();

        $categoryAndTree = collect(['category' => $category, 'tree' => $tree]);

        return $categoryAndTree;
    }


    public function updateBranch($child_id, $parent_id, $title, $root = 'catalog') : void
    {

        $node = $this->findOrFail($child_id);
        $parent = $this->findOrFail($parent_id);

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

        $this->pathDescendants($node, $node->path);
    }


    public function searchPath($path) : \Illuminate\Support\Collection
    {

        $category = $this->where('path', '=', $path)->first();

        $navigationMenu = Category::getNavigationMenu($category);

        return $navigationMenu;
    }

    public function getBranch($part_path) : \Illuminate\Support\Collection
    {

        $path = 'catalog/' . $part_path;

        $category = $this->where('path',$path)->first();

        $navigationMenu = $this->getNavigationMenu($category);

        $products = $this->find($category->id)->selectedProducts;

        $this->descendants($category, $products);

        $queries = collect(['products'=>$products, 'navigationMenu'=>$navigationMenu]);

        return $queries;

    }


    private function pathDescendants($parentNode, $path) : void
    {

        $node = null;
        foreach ($parentNode['children'] as $value){

            $value->path = $path . '/' . $value->slug;
            $value->save();

            if(isset($value['children'][0])){
                $this->pathDescendants($value, $value->path);
            }
        }

    }

    public function getNavigationMenu($category) : \Illuminate\Support\Collection
    {
        $title = $category->ancestors()->pluck('title');
        $paths = $category->ancestors()->pluck('path');

        $paths->push($category->path);
        $title->push($category->title);

        $navigationMenu = collect(['title'=>$title, 'paths'=>$paths]);

        return $navigationMenu;
    }


        private function descendants($parentNode, &$products) : void
        {

            foreach ($parentNode['children'] as $node) {

                $results = $this->where('category_id', $node->id);
                foreach ($results as $res){
                    array_push($products, $res);
                }


                $this->descendants($node, $products);

            }
        }




}
