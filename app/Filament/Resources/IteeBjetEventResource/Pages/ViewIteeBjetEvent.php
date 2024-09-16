<?php

namespace App\Filament\Resources\IteeBjetEventResource\Pages;

use App\Filament\Resources\IteeBjetEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeBjetEvent extends ViewRecord
{
    protected static string $resource = IteeBjetEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
