<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * Otomatis ekstrak URL embed jika admin mem-paste tag <iframe> dari Google Maps.
     */
    protected function googleMapsLink(): Attribute
    {
        return Attribute::make(
            set: function (?string $value) {
                if (!$value) return $value;

                $trimmed = trim($value);

                // Jika user mem-paste full iframe code dari Google Maps "Sematkan peta"
                if (preg_match('/src=["\']([^"\']+)["\']/', $trimmed, $matches)) {
                    return $matches[1];
                }

                return $trimmed;
            },
            get: function (?string $value) {
                if (!$value) {
                    return 'https://maps.google.com/maps?q=-6.2238125,106.819778&z=14&ie=UTF8&iwloc=&output=embed';
                }

                // Jika sudah merupakan embed URL resmi
                if (str_contains($value, '/embed') || str_contains($value, 'output=embed')) {
                    return $value;
                }

                // Jika link maps.google.com biasa, tambahkan query embed
                if (str_contains($value, 'maps.google.com')) {
                    $separator = str_contains($value, '?') ? '&' : '?';
                    return $value . $separator . 'output=embed';
                }

                return $value;
            }
        );
    }
}
