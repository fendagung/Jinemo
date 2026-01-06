<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();

        return view('admin.dashboard', compact('totalMenu'));
    }
}
