<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class MealSystemController extends Controller
{
    public function createMealSystemView(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.mealSystem.create', ['title' => 'Create a Meal System']);
    }
}
