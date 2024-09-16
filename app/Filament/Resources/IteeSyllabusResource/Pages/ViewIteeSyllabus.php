<?php

namespace App\Filament\Resources\IteeSyllabusResource\Pages;

use App\Filament\Resources\IteeSyllabusResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeSyllabus extends ViewRecord
{
    protected static string $resource = IteeSyllabusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
