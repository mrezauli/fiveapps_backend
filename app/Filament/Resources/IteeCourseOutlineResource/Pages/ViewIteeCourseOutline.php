<?php

namespace App\Filament\Resources\IteeCourseOutlineResource\Pages;

use App\Filament\Resources\IteeCourseOutlineResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeCourseOutline extends ViewRecord
{
    protected static string $resource = IteeCourseOutlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
