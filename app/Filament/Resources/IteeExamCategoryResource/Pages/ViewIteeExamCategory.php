<?php

namespace App\Filament\Resources\IteeExamCategoryResource\Pages;

use App\Filament\Resources\IteeExamCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeExamCategory extends ViewRecord
{
    protected static string $resource = IteeExamCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
