<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class AdminPanelController extends Controller
{
    public function admin()
    {
        return view('layouts/admin_master');
    }



}
