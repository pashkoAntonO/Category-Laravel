<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\CategoryRequest;


class BranchController extends TreeController
{

    public function create()
    {
        return view('Branch/create')->with(['tree'=> Category::getTree(), 'lvl'=>0 ]);
    }

    public function store(CategoryRequest $request)
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

    public function update(CategoryRequest $request)
    {
        $category = new Category();
        $category->updateBranch($request->child_id,$request->parent_id, $request->title);
        return redirect('/');
    }
}
