<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IteeExamNoticeResource\Pages;
use App\Filament\Resources\IteeExamNoticeResource\RelationManagers;
use App\Models\IteeExamNotice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IteeExamNoticeResource extends Resource
{
    protected static ?string $model = IteeExamNotice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIteeExamNotices::route('/'),
            'create' => Pages\CreateIteeExamNotice::route('/create'),
            'view' => Pages\ViewIteeExamNotice::route('/{record}'),
            'edit' => Pages\EditIteeExamNotice::route('/{record}/edit'),
        ];
    }
}
