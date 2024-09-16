<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IteeExamResultResource\Pages;
use App\Filament\Resources\IteeExamResultResource\RelationManagers;
use App\Models\IteeExamResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IteeExamResultResource extends Resource
{
    protected static ?string $model = IteeExamResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('passer_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('examine_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('name')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('dob')
                    ->required(),
                Forms\Components\Toggle::make('morning_passer'),
                Forms\Components\Toggle::make('afternoon_passer'),
                Forms\Components\TextInput::make('passing_session')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('passer_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('examine_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('morning_passer')
                    ->boolean(),
                Tables\Columns\IconColumn::make('afternoon_passer')
                    ->boolean(),
                Tables\Columns\TextColumn::make('passing_session')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
            'index' => Pages\ListIteeExamResults::route('/'),
            'create' => Pages\CreateIteeExamResult::route('/create'),
            'view' => Pages\ViewIteeExamResult::route('/{record}'),
            'edit' => Pages\EditIteeExamResult::route('/{record}/edit'),
        ];
    }
}
