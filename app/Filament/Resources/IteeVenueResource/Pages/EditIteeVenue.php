<?php

namespace App\Filament\Resources\IteeVenueResource\Pages;

use App\Filament\Resources\IteeVenueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeVenue extends EditRecord
{
    protected static string $resource = IteeVenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
