<?php

namespace App\Filament\Resources\IteeRecentEventsResource\Pages;

use App\Filament\Resources\IteeRecentEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeRecentEvents extends ViewRecord
{
    protected static string $resource = IteeRecentEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
