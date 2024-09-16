<?php

namespace App\Filament\Resources\IteeCourseOutlineResource\Pages;

use App\Filament\Resources\IteeCourseOutlineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeCourseOutline extends EditRecord
{
    protected static string $resource = IteeCourseOutlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
