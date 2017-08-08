<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\View\View;


class TreeController extends Controller
{

    public function main() : View
    {
        $category = new Category();
        $tree = $category->getTree();

        return view('Tree/main')->withTree($tree);
    }

}
