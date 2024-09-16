<?php

namespace App\Filament\Resources\IteeBjetEventResource\Pages;

use App\Filament\Resources\IteeBjetEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeBjetEvent extends EditRecord
{
    protected static string $resource = IteeBjetEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
