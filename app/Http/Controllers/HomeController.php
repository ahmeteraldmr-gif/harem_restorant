<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use App\Models\GalleryImage;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = MenuItem::where('featured', true)->where('active', true)->with('category')->take(6)->get();
        $galleryImages = GalleryImage::where('active', true)->orderBy('order')->take(6)->get();
        return view('home', compact('featuredItems', 'galleryImages'));
    }
}
