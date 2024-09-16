<?php

namespace App\Filament\Resources\IteeExamRegistrationResource\Pages;

use App\Filament\Resources\IteeExamRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeExamRegistration extends ViewRecord
{
    protected static string $resource = IteeExamRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
