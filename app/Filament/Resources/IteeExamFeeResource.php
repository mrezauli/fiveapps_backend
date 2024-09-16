<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IteeExamFeeResource\Pages;
use App\Filament\Resources\IteeExamFeeResource\RelationManagers;
use App\Models\IteeExamFee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IteeExamFeeResource extends Resource
{
    protected static ?string $model = IteeExamFee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('itee_exam_type_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('itee_exam_category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('fee')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('exam_end')
                    ->required(),
                Forms\Components\DateTimePicker::make('exam_start')
                    ->required(),
                Forms\Components\Textarea::make('details')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('itee_exam_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('itee_exam_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_end')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_start')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListIteeExamFees::route('/'),
            'create' => Pages\CreateIteeExamFee::route('/create'),
            'view' => Pages\ViewIteeExamFee::route('/{record}'),
            'edit' => Pages\EditIteeExamFee::route('/{record}/edit'),
        ];
    }
}
