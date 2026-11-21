<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'whatsapp',
        'phone',
        'email',
        'address',
        'business_hours',
        'google_maps_link',
        'google_rating',
        'happy_customers_label',
        'whatsapp_link',
        'instagram_link',
        'tiktok_link',
    ];
}
