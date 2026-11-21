<?php

namespace App\Filament\Resources\Facilities\Pages;

use App\Filament\Resources\Facilities\FacilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFacility extends EditRecord
{
    protected static string $resource = FacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /**
     * Saat form di-load untuk edit, kalau nilai `icon` yang tersimpan
     * di DB tidak ada di daftar opsi bawaan, otomatis isi icon_custom
     * dengan nilai tersebut dan set icon ke 'custom' supaya field manual
     * langsung muncul & terisi.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $knownIcons = array_keys(
            array_filter(
                \App\Filament\Resources\Facilities\Schemas\FacilityForm::$iconOptions,
                fn ($key) => $key !== 'custom',
                ARRAY_FILTER_USE_KEY
            )
        );

        if (isset($data['icon']) && ! in_array($data['icon'], $knownIcons, true)) {
            $data['icon_custom'] = $data['icon'];
            $data['icon']        = 'custom';
        }

        return $data;
    }

    /**
     * Kalau admin pilih "Lainnya (ketik manual)", ambil nilai dari
     * icon_custom lalu simpan ke kolom `icon` yang sesungguhnya.
     * Field icon_custom tidak ada di tabel, jadi dibuang sebelum update.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['icon'] ?? null) === 'custom') {
            $data['icon'] = $data['icon_custom'] ?? '';
        }

        unset($data['icon_custom']);

        return $data;
    }
}
