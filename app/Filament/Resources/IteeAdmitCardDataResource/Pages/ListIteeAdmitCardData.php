<?php

namespace App\Filament\Resources\IteeAdmitCardDataResource\Pages;

use App\Filament\Resources\IteeAdmitCardDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeAdmitCardData extends ListRecords
{
    protected static string $resource = IteeAdmitCardDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
