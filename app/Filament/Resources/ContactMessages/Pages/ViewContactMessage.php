<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Group;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Pesan')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama'),
                        TextEntry::make('email')
                            ->label('Email'),
                        TextEntry::make('phone')
                            ->label('No. Telepon')
                            ->placeholder('—'),
                        TextEntry::make('created_at')
                            ->label('Diterima')
                            ->dateTime('d M Y, H:i'),
                        TextEntry::make('message')
                            ->label('Isi Pesan')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    protected function afterFill(): void
    {
        // Auto-mark as read when viewed
        $this->record->update(['is_read' => true]);
    }
}
