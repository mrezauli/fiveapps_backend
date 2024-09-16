<?php

namespace App\Filament\Resources\IteeExamNoticeResource\Pages;

use App\Filament\Resources\IteeExamNoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeExamNotice extends ViewRecord
{
    protected static string $resource = IteeExamNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
