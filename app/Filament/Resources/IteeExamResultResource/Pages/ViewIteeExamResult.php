<?php

namespace App\Filament\Resources\IteeExamResultResource\Pages;

use App\Filament\Resources\IteeExamResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeExamResult extends ViewRecord
{
    protected static string $resource = IteeExamResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
