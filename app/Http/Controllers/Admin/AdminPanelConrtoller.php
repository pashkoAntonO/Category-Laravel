<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPanelConrtoller extends Controller
{
    public function admin(){
        return view('layouts/admin_master');
    }
}
