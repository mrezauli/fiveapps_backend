<?php

namespace App\Filament\Resources\IteeRecentEventsResource\Pages;

use App\Filament\Resources\IteeRecentEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeRecentEvents extends ListRecords
{
    protected static string $resource = IteeRecentEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
