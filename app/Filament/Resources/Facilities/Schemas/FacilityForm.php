<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class FacilityForm
{
    /** Daftar ikon bawaan yang tersedia di dropdown. */
    public static array $iconOptions = [
        'wifi'          => 'WiFi Gratis',
        'circle-parking'=> 'Parkir Tersedia',
        'wind'          => 'AC / Ruangan Sejuk',
        'zap'           => 'Colokan Listrik',
        'music'         => 'Live Music',
        'sun'           => 'Area Outdoor',
        'dog'           => 'Ramah Hewan Peliharaan',
        'baby'          => 'Ramah Anak',
        'accessibility' => 'Akses Kursi Roda',
        'credit-card'   => 'Pembayaran Non-Tunai',
        'cigarette-off' => 'Area Bebas Rokok',
        'shield'        => 'Keamanan / CCTV',
        'clock'         => 'Buka 24 Jam',
        'tv'            => 'TV / Nonton Bareng',
        'umbrella'      => 'Area Teduh',
        'custom'        => 'Lainnya (ketik manual)',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Fasilitas')
                    ->required(),

                Select::make('icon')
                    ->label('Ikon Fasilitas')
                    ->options(self::$iconOptions)
                    ->searchable()
                    ->required()
                    ->live(),

                TextInput::make('icon_custom')
                    ->label('Nama Ikon Lucide (manual)')
                    ->helperText('Cari nama ikon yang sesuai di lucide.dev/icons')
                    ->placeholder('contoh: coffee, sparkles, flame …')
                    ->visible(fn (Get $get) => $get('icon') === 'custom')
                    ->required(fn (Get $get) => $get('icon') === 'custom'),

                Placeholder::make('icon_preview')
                    ->label('Preview Ikon')
                    ->content(function (Get $get): \Illuminate\Support\HtmlString {
                        $icon = $get('icon') === 'custom'
                            ? $get('icon_custom')
                            : $get('icon');

                        if (blank($icon)) {
                            return new \Illuminate\Support\HtmlString(
                                '<span class="text-sm text-gray-400 italic">Pilih ikon terlebih dahulu…</span>'
                            );
                        }

                        // Lucide icon CDN via unpkg — render <img> dari SVG file
                        $slug  = e($icon);
                        $label = self::$iconOptions[$icon] ?? $icon;
                        $url   = "https://unpkg.com/lucide-static@latest/icons/{$slug}.svg";

                        return new \Illuminate\Support\HtmlString(
                            <<<HTML
                            <div style="display:flex;align-items:center;gap:12px;">
                                <img
                                    src="{$url}"
                                    alt="{$label}"
                                    width="32"
                                    height="32"
                                    style="filter:invert(0);opacity:.85;"
                                    onerror="this.style.display='none';this.nextElementSibling.style.display='block';"
                                />
                                <span style="display:none;color:#ef4444;font-size:.875rem;">
                                    ⚠ Ikon '<strong>{$slug}</strong>' tidak ditemukan di Lucide.
                                </span>
                                <span style="font-size:.875rem;color:#6b7280;">{$label}</span>
                            </div>
                            HTML
                        );
                    })
                    ->visible(fn (Get $get) => filled($get('icon')))
                    ->live(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
