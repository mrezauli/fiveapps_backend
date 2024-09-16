<?php

namespace App\Filament\Resources\IteeExamRegistrationResource\Pages;

use App\Filament\Resources\IteeExamRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeExamRegistration extends EditRecord
{
    protected static string $resource = IteeExamRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
