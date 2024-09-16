<?php

namespace App\Filament\Resources\IteeBjetEventResource\Pages;

use App\Filament\Resources\IteeBjetEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeBjetEvents extends ListRecords
{
    protected static string $resource = IteeBjetEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
