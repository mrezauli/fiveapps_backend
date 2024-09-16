<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IteeExamRegistrationResource\Pages;
use App\Filament\Resources\IteeExamRegistrationResource\RelationManagers;
use App\Models\IteeExamRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IteeExamRegistrationResource extends Resource
{
    protected static ?string $model = IteeExamRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('examine_id')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('itee_venue_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('itee_exam_category_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('itee_exam_type_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('exam_center')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('exam_fees')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('exam_fees_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('itee_book_id')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('itee_book_fees')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('full_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('dob')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('post_code')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('occupation')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('linkedin')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('photo')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('education_qualification')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('subject_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('passing_year')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('institute_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('result')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('previous_passing_id')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('transaction_id')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('payment')
                    ->required()
                    ->maxLength(255)
                    ->default('Unpaid'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('examine_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('itee_venue_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('itee_exam_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('itee_exam_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_center')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_fees')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_fees_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('itee_book_fees')
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('occupation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linkedin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('photo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('education_qualification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('passing_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('institute_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('result')
                    ->searchable(),
                Tables\Columns\TextColumn::make('previous_passing_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
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
            'index' => Pages\ListIteeExamRegistrations::route('/'),
            'create' => Pages\CreateIteeExamRegistration::route('/create'),
            'view' => Pages\ViewIteeExamRegistration::route('/{record}'),
            'edit' => Pages\EditIteeExamRegistration::route('/{record}/edit'),
        ];
    }
}
