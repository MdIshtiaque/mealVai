<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.dashboard');
    }
}
