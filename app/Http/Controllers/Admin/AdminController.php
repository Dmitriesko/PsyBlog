<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }
}
