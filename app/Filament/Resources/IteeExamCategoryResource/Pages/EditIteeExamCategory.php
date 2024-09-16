<?php

namespace App\Filament\Resources\IteeExamCategoryResource\Pages;

use App\Filament\Resources\IteeExamCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeExamCategory extends EditRecord
{
    protected static string $resource = IteeExamCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
