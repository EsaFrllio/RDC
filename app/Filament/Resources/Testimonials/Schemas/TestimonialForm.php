<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('role')
                    ->placeholder('e.g. Specialty Coffee Lover'),
                Select::make('rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->default(5)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Tampilkan di Website (Approved)')
                    ->default(true)
                    ->helperText('Aktifkan agar ulasan ini tampil secara publik di website'),
                FileUpload::make('avatar')
                    ->disk('public')
                    ->directory('testimonials')
                    ->image(),
                Textarea::make('review')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
