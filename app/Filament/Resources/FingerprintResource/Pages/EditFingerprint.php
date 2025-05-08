<?php

namespace App\Filament\Resources\FingerprintResource\Pages;

use App\Filament\Resources\FingerprintResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFingerprint extends EditRecord
{
    protected static string $resource = FingerprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
