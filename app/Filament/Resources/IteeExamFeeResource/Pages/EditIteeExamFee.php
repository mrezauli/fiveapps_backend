<?php

namespace App\Filament\Resources\IteeExamFeeResource\Pages;

use App\Filament\Resources\IteeExamFeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIteeExamFee extends EditRecord
{
    protected static string $resource = IteeExamFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
