<?php

namespace App\Filament\Resources\IteeVenueResource\Pages;

use App\Filament\Resources\IteeVenueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeVenue extends ViewRecord
{
    protected static string $resource = IteeVenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
