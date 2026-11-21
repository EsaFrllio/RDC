<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Menu extends Model
{
    protected $fillable = [
        'menu_category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_featured',
        'sort_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'price' => 'float',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url', 'formatted_price'];

    protected static function booted(): void
    {
        static::saving(function (self $menu) {
            if (empty($menu->slug) || $menu->isDirty('name')) {
                $base = Str::slug($menu->name);
                $slug = $base;
                $i    = 1;
                while (
                    static::where('slug', $slug)
                        ->where('id', '!=', $menu->id ?? 0)
                        ->exists()
                ) {
                    $slug = $base . '-' . (++$i);
                }
                $menu->slug = $slug;
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/no-image.jpg');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        return asset('images/no-image.jpg');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp' . number_format((float) $this->price, 0, ',', '.');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeAvailable($query)
    {
        return $query;
    }
}
