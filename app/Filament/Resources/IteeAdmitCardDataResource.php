<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IteeAdmitCardDataResource\Pages;
use App\Filament\Resources\IteeAdmitCardDataResource\RelationManagers;
use App\Models\IteeAdmitCardData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IteeAdmitCardDataResource extends Resource
{
    protected static ?string $model = IteeAdmitCardData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('examine_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('name')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sex')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob')
                    ->required(),
                Forms\Components\TextInput::make('area')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('area_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('site')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('room_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('post_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exempt')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('examine_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area')
                    ->searchable(),
                Tables\Columns\TextColumn::make('area_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('site')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exempt')
                    ->searchable(),
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
            'index' => Pages\ListIteeAdmitCardData::route('/'),
            'create' => Pages\CreateIteeAdmitCardData::route('/create'),
            'view' => Pages\ViewIteeAdmitCardData::route('/{record}'),
            'edit' => Pages\EditIteeAdmitCardData::route('/{record}/edit'),
        ];
    }
}
