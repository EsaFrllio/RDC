<?php

namespace App\Filament\Resources\Promos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PromoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Promo / Event Title')
                    ->required(),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('description')
                    ->label('Description & Details')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('promos')
                    ->image()
                    ->columnSpanFull(),
                DatePicker::make('start_date')
                    ->label('Start Date'),
                DatePicker::make('end_date')
                    ->label('End Date'),
                Toggle::make('is_active')
                    ->label('Active / Visible')
                    ->default(true)
                    ->required(),
            ]);
    }
}
