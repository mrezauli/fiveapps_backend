<?php

namespace App\Filament\Resources\IteeExamTypeResource\Pages;

use App\Filament\Resources\IteeExamTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeExamType extends EditRecord
{
    protected static string $resource = IteeExamTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
