<?php

namespace App\Filament\Resources\IteeExamResultResource\Pages;

use App\Filament\Resources\IteeExamResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeExamResults extends ListRecords
{
    protected static string $resource = IteeExamResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
