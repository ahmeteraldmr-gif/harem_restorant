<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::where('active', true)
            ->where('category', '!=', 'yemekler')
            ->orderBy('order')
            ->get();
        return view('gallery', compact('images'));
    }
}
