<?php

namespace App\Filament\Resources\IteeAdmitCardDataResource\Pages;

use App\Filament\Resources\IteeAdmitCardDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeAdmitCardData extends EditRecord
{
    protected static string $resource = IteeAdmitCardDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
