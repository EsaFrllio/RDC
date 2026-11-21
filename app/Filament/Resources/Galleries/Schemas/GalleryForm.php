<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('galleries')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('caption')
                    ->required(),
                Select::make('category')
                    ->options([
                        'Interior' => 'Interior',
                        'Drinks' => 'Drinks',
                        'Foods' => 'Foods',
                        'Events' => 'Events',
                        'Craft' => 'Craft',
                        'Design' => 'Design',
                    ])
                    ->required(),
            ]);
    }
}
