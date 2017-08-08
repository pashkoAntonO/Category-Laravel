<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\View\View;


class TreeController extends Controller
{


    public static function Tree(){
        $category = new Category();
        $tree = $category->getTree();

        return $tree;
    }


    public function main() : View
    {
        return view('Tree/main')->withTree($this->Tree());
    }

}
