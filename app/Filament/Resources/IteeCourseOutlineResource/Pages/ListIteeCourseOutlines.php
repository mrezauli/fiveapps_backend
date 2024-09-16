<?php

namespace App\Filament\Resources\IteeCourseOutlineResource\Pages;

use App\Filament\Resources\IteeCourseOutlineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeCourseOutlines extends ListRecords
{
    protected static string $resource = IteeCourseOutlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
