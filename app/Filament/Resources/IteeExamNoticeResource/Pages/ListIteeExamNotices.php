<?php

namespace App\Filament\Resources\IteeExamNoticeResource\Pages;

use App\Filament\Resources\IteeExamNoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeExamNotices extends ListRecords
{
    protected static string $resource = IteeExamNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}