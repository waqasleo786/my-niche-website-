<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Account Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation) => $operation === 'create')
                            ->helperText('Leave blank to keep current password'),

                        Select::make('roles')
                            ->label('Role')
                            ->options(Role::pluck('name', 'name'))
                            ->multiple()
                            ->preload()
                            ->columnSpanFull(),
                    ]),

                Section::make('B2B Details')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_b2b')
                            ->label('Is B2B Customer')
                            ->reactive(),

                        Toggle::make('is_verified')
                            ->label('B2B Approved')
                            ->helperText('Approve B2B account for wholesale pricing'),

                        TextInput::make('company_name')
                            ->maxLength(255),

                        TextInput::make('ntn_number')
                            ->label('NTN Number')
                            ->maxLength(100),
                    ]),

                Section::make('Page Access')
                    ->description('Grant or revoke access to restricted pages')
                    ->schema([
                        Toggle::make('gift_builder_access')
                            ->label('Gift Box Builder Access')
                            ->helperText('Allow this user to access the /gift-builder page')
                            ->dehydrated(false)
                            ->afterStateHydrated(function ($component, $record) {
                                if ($record) {
                                    $component->state($record->hasPermissionTo('view_gift_builder'));
                                }
                            }),
                    ]),

            ]);
    }
}
