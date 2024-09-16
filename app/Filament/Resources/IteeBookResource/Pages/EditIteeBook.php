<?php

namespace App\Filament\Resources\IteeBookResource\Pages;

use App\Filament\Resources\IteeBookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeBook extends EditRecord
{
    protected static string $resource = IteeBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
