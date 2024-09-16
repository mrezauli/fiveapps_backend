<?php

namespace App\Filament\Resources\IteeExamFeeResource\Pages;

use App\Filament\Resources\IteeExamFeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIteeExamFees extends ListRecords
{
    protected static string $resource = IteeExamFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
