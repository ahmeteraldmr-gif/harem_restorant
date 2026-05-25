<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuItem;

class MenuController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::where('active', true)->orderBy('order')->with(['items' => function($q) {
            $q->where('active', true)->orderBy('order');
        }])->get();

        return view('menu', compact('categories'));
    }
}
