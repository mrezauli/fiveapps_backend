<?php

namespace App\Filament\Resources\IteeProgramResource\Pages;

use App\Filament\Resources\IteeProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeProgram extends ViewRecord
{
    protected static string $resource = IteeProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
