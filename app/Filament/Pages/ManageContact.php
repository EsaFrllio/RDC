<?php

namespace App\Filament\Pages;

use App\Models\Contact;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

class ManageContact extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?string $navigationLabel = 'About & Contact Us';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Manage Contact & Location Settings';

    protected string $view = 'filament.pages.manage-contact';

    public ?array $data = [];

    public function mount(): void
    {
        $contact = Contact::firstOrCreate(
            ['id' => 1],
            [
                'whatsapp' => '1234567890',
                'phone' => '+1 (234) 567-890',
                'email' => 'hello@rdcbear.com',
                'address' => '128 Minimalist Ave, Design District, City Center 10012',
                'business_hours' => 'Mon - Fri: 7:00 AM - 6:00 PM | Sat - Sun: 8:00 AM - 7:00 PM',
                'google_maps_link' => 'https://maps.google.com/maps?q=-6.2238125,106.819778&z=14&ie=UTF8&iwloc=&output=embed',
            ]
        );

        $this->form->fill($contact->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('whatsapp')
                    ->label('WhatsApp Number')
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->required(),
                TextInput::make('email')
                    ->label('Contact Email')
                    ->email()
                    ->required(),
                Textarea::make('address')
                    ->label('Physical Address')
                    ->required(),
                Textarea::make('business_hours')
                    ->label('Business Opening Hours')
                    ->required(),
                TextInput::make('google_maps_link')
                    ->label('Google Maps Embed URL / Kode Iframe')
                    ->helperText('Buka Google Maps -> Bagikan (Share) -> Sematkan peta (Embed map) -> Salin HTML atau paste URL src-nya di sini.')
                    ->required(),
                TextInput::make('google_rating')
                    ->label('Google Rating (e.g. 4.9)')
                    ->nullable()
                    ->placeholder('e.g. 4.9'),
                TextInput::make('happy_customers_label')
                    ->label('Happy Customers Label (e.g. 1,500+)')
                    ->nullable()
                    ->placeholder('e.g. 1,500+'),
                TextInput::make('whatsapp_link')
                    ->label('WhatsApp Direct Link')
                    ->url()
                    ->nullable()
                    ->placeholder('https://wa.me/1234567890'),
                TextInput::make('instagram_link')
                    ->label('Instagram Profile Link')
                    ->url()
                    ->nullable()
                    ->placeholder('https://instagram.com/rdcbear'),
                TextInput::make('tiktok_link')
                    ->label('TikTok Profile Link')
                    ->url()
                    ->nullable()
                    ->placeholder('https://tiktok.com/@rdcbear'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $contact = Contact::firstOrCreate(['id' => 1]);
        $contact->update($data);

        Notification::make()
            ->title('Contact settings updated successfully.')
            ->success()
            ->send();
    }
}
