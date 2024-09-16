<?php

namespace App\Filament\Resources\IteeSyllabusResource\Pages;

use App\Filament\Resources\IteeSyllabusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeSyllabus extends EditRecord
{
    protected static string $resource = IteeSyllabusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
