<?php

namespace App\Filament\Resources\IteeBookResource\Pages;

use App\Filament\Resources\IteeBookResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeBook extends ViewRecord
{
    protected static string $resource = IteeBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
