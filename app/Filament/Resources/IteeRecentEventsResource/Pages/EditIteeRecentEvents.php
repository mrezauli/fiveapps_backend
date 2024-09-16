<?php

namespace App\Filament\Resources\IteeRecentEventsResource\Pages;

use App\Filament\Resources\IteeRecentEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeRecentEvents extends EditRecord
{
    protected static string $resource = IteeRecentEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
