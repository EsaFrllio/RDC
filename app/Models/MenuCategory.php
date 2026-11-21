<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MenuCategory extends Model
{
    protected $fillable = ['name', 'slug', 'sort_order'];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $category) {
            if (empty($category->slug) || $category->isDirty('name')) {
                $base = Str::slug($category->name);
                $slug = $base;
                $i    = 1;
                while (
                    static::where('slug', $slug)
                        ->where('id', '!=', $category->id ?? 0)
                        ->exists()
                ) {
                    $slug = $base . '-' . (++$i);
                }
                $category->slug = $slug;
            }
        });
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'menu_category_id')->orderBy('sort_order');
    }
}
