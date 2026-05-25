<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCategory extends Model
{
    protected $fillable = ['name', 'name_en', 'name_es', 'name_ar', 'name_ru', 'slug', 'icon', 'order', 'active'];

    protected $casts = ['active' => 'boolean'];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    public function getTranslatedNameAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'tr') {
            return $this->name;
        }

        $field = 'name_' . $locale;
        return $this->{$field} ?: $this->name;
    }
}
