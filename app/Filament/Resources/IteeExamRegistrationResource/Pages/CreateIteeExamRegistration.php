<?php

namespace App\Filament\Resources\IteeExamRegistrationResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\IteeExamRegistrationResource;
use Filament\Forms\Components\Wizard\Step;

class CreateIteeExamRegistration extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = IteeExamRegistrationResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Exam')
                ->description('Exam Details Info')
                ->schema([
                    Select::make('itee_venue_id')
                        ->relationship('venue', 'name'),
                    Select::make('itee_exam_category_id')
                        ->relationship('category', 'name'),
                    TextInput::make('itee_exam_type_id')
                        ->numeric()
                        ->default(null),
                    TextInput::make('exam_center')
                        ->maxLength(255)
                        ->default(null),

                    TextInput::make('examine_id')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('user_id')
                        ->numeric()
                        ->default(null),
                    TextInput::make('exam_fees')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('exam_fees_id')
                        ->required()
                        ->numeric(),
                    Textarea::make('itee_book_id')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('itee_book_fees')
                        ->maxLength(255)
                        ->default(null),
                ]),
            Step::make('Personal')
                ->description('Details about you')
                ->schema([
                    TextInput::make('full_name')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('email')
                        ->email()
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('dob')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('gender')
                        ->maxLength(255)
                        ->default(null),
                    Textarea::make('address')
                        ->columnSpanFull(),
                    TextInput::make('post_code')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('occupation')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('linkedin')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('photo')
                        ->maxLength(255)
                        ->default(null),
                ]),
            Step::make('Education')
                ->description('Educational Info')
                ->schema([
                    TextInput::make('education_qualification')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('subject_name')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('passing_year')
                        ->numeric()
                        ->default(null),
                    TextInput::make('institute_name')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('result')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('previous_passing_id')
                        ->maxLength(255)
                        ->default(null),
                ]),
            Step::make('Payment')
                ->description('Fee for exam')
                ->schema([
                    TextInput::make('transaction_id')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('payment')
                        ->required()
                        ->maxLength(255)
                        ->default('Unpaid'),
                    TextInput::make('status')
                        ->required()
                        ->numeric(),
                ]),
        ];
    }
}