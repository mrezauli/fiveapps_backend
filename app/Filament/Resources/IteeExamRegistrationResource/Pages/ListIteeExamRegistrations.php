<?php

namespace App\Filament\Resources\IteeExamRegistrationResource\Pages;

use App\Filament\Resources\IteeExamRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeExamRegistrations extends ListRecords
{
    protected static string $resource = IteeExamRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
