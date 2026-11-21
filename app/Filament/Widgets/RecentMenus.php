<?php

namespace App\Filament\Widgets;

use App\Models\Menu;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentMenus extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Menu::query()->latest()->take(5))
            ->heading('Recent Menu Additions')
            ->paginated(false)
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->defaultImageUrl(asset('images/no-image.jpg'))
                    ->square(),
                TextColumn::make('name')
                    ->label('Item Name'),
                TextColumn::make('category.name')
                    ->label('Category'),
                TextColumn::make('price')
                    ->money('IDR', locale: 'id'),
                TextColumn::make('created_at')
                    ->label('Added')
                    ->since(),
            ]);
    }
}
