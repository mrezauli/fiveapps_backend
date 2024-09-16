<?php

namespace App\Filament\Resources\IteeExamTypeResource\Pages;

use App\Filament\Resources\IteeExamTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeExamType extends ViewRecord
{
    protected static string $resource = IteeExamTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
