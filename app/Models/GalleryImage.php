<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['title', 'image', 'category', 'order', 'active'];

    protected $casts = ['active' => 'boolean'];
}
