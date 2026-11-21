<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = ['image', 'caption', 'category'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        // Handle external URLs (Unsplash, etc.) stored directly in the image field
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Handle local storage paths
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        // Fallback placeholder
        return asset('images/no-image.jpg');
    }
}
