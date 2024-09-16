<?php

namespace App\Filament\Resources\IteeNoticeResource\Pages;

use App\Filament\Resources\IteeNoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeNotice extends EditRecord
{
    protected static string $resource = IteeNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
