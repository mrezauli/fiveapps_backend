<?php

namespace App\Filament\Resources\IteeSyllabusResource\Pages;

use App\Filament\Resources\IteeSyllabusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeSyllabi extends ListRecords
{
    protected static string $resource = IteeSyllabusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
