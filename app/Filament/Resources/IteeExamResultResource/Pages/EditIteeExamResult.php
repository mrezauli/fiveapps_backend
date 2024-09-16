<?php

namespace App\Filament\Resources\IteeExamResultResource\Pages;

use App\Filament\Resources\IteeExamResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeExamResult extends EditRecord
{
    protected static string $resource = IteeExamResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
