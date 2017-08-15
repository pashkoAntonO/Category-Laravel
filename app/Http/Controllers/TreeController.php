<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\View\View;



class TreeController extends Controller
{
    public function main()
    {
        return view('Tree/main')->withTree(Category::getTree());
    }
}
