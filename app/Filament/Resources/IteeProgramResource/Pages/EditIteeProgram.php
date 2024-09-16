<?php

namespace App\Filament\Resources\IteeProgramResource\Pages;

use App\Filament\Resources\IteeProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeProgram extends EditRecord
{
    protected static string $resource = IteeProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
