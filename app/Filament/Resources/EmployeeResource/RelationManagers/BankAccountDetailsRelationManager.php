<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Tables\Table;
use Filament\Tables;

class BankAccountDetailsRelationManager extends \Filament\Resources\RelationManagers\RelationManager
{
    protected static string $relationship = 'bank_account_details';

    protected static ?string $title = 'Employee bank account details';

    protected static ?string $recordTitleAttribute = 'account_number';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('account_holder_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('account_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bank_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('branch')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bank_code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account_number'),
                Tables\Columns\TextColumn::make('bank_name'),
                Tables\Columns\TextColumn::make('branch'),
                Tables\Columns\TextColumn::make('bank_code'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }
}
