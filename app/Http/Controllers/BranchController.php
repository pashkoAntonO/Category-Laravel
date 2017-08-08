<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\View\View;


class BranchController extends TreeController
{

    public function create() : View
    {
        $category = new Category();
        $tree = $category->getTree();

        return view('Branch/create')->withTree($tree);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->createBranch($request->parent_id, $request->title);

        return redirect('/');
    }


    public function show(Request $request)
    {
        $category = new Category();
        $categoryCollect = $category->getBranch($request->path);

        return view('Branch/show')->with(['paths'=>$categoryCollect['navigationMenu']['paths'],
            'products'=>$categoryCollect['products'],
            'title'=> $categoryCollect['navigationMenu']['title'],
            'path'=>$request->path]);

    }


    public function edit(Request $request)
    {
        $category = new Category();
        $branch = $category->editBranch($request->id);

        return view('Branch/edit')->with(['element'=>$branch['category'], 'tree'=>$branch['tree'], 'lvl'=> 0]);
    }

    public function update(Request $request)
    {

        $category = new Category();

        $category->updateBranch($request->child_id,$request->parent_id, $request->title);

        return redirect('/');

    }
}
