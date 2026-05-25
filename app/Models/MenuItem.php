<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_category_id', 'name', 'name_en', 'name_es', 'name_ar', 'name_ru', 
        'description', 'description_en', 'description_es', 'description_ar', 'description_ru', 
        'price', 'image', 'featured', 'active', 'order'
    ];

    protected $casts = ['featured' => 'boolean', 'active' => 'boolean', 'price' => 'decimal:2'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function getTranslatedNameAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'tr') return $this->name;
        $field = 'name_' . $locale;
        return $this->{$field} ?: $this->name;
    }

    public function getTranslatedDescriptionAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'tr') return $this->description;
        $field = 'description_' . $locale;
        return $this->{$field} ?: $this->description;
    }
}
