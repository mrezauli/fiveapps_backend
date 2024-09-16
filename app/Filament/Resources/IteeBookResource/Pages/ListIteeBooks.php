<?php

namespace App\Filament\Resources\IteeBookResource\Pages;

use App\Filament\Resources\IteeBookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeBooks extends ListRecords
{
    protected static string $resource = IteeBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
