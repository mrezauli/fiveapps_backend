<?php

namespace App\Filament\Resources\IteeNoticeResource\Pages;

use App\Filament\Resources\IteeNoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeNotice extends ViewRecord
{
    protected static string $resource = IteeNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
