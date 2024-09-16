<?php

namespace App\Filament\Resources\IteeExamNoticeResource\Pages;

use App\Filament\Resources\IteeExamNoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeExamNotice extends EditRecord
{
    protected static string $resource = IteeExamNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
