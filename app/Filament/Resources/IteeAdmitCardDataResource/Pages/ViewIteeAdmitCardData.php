<?php

namespace App\Filament\Resources\IteeAdmitCardDataResource\Pages;

use App\Filament\Resources\IteeAdmitCardDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeAdmitCardData extends ViewRecord
{
    protected static string $resource = IteeAdmitCardDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
