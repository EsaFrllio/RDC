<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                DatePicker::make('reservation_date')
                    ->label('Reservation Date'),
                Select::make('reservation_time')
                    ->label('Reservation Time')
                    ->options([
                        '07.00' => '07.00',
                        '08.00' => '08.00',
                        '09.00' => '09.00',
                        '10.00' => '10.00',
                        '11.00' => '11.00',
                        '12.00' => '12.00',
                        '13.00' => '13.00',
                        '14.00' => '14.00',
                        '15.00' => '15.00',
                        '16.00' => '16.00',
                        '17.00' => '17.00',
                        '18.00' => '18.00',
                        '19.00' => '19.00',
                        '20.00' => '20.00',
                        '21.00' => '21.00',
                    ]),
                TextInput::make('guest_count')
                    ->label('Number of Guests')
                    ->required()
                    ->numeric()
                    ->default(1),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('message')
                    ->label('Customer Message')
                    ->columnSpanFull(),
            ]);
    }
}
