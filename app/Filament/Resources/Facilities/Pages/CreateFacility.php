<?php

namespace App\Filament\Resources\Facilities\Pages;

use App\Filament\Resources\Facilities\FacilityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFacility extends CreateRecord
{
    protected static string $resource = FacilityResource::class;

    /**
     * Kalau admin pilih "Lainnya (ketik manual)", ambil nilai dari
     * icon_custom lalu simpan ke kolom `icon` yang sesungguhnya.
     * Field icon_custom tidak ada di tabel, jadi dibuang sebelum insert.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (($data['icon'] ?? null) === 'custom') {
            $data['icon'] = $data['icon_custom'] ?? '';
        }

        unset($data['icon_custom']);

        return $data;
    }
}
