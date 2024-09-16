<?php

namespace App\Filament\Resources\IteeExamFeeResource\Pages;

use App\Filament\Resources\IteeExamFeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIteeExamFee extends ViewRecord
{
    protected static string $resource = IteeExamFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
