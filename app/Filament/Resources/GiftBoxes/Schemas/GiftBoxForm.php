<?php

declare(strict_types=1);

namespace App\Filament\Resources\GiftBoxes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GiftBoxForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Box Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Small Box, Medium Box'),

                        TextInput::make('capacity_units')
                            ->label('Capacity (size units)')
                            ->required()
                            ->numeric()
                            ->minValue(0.5)
                            ->step(0.5)
                            ->helperText('Max total size_units this box can hold (e.g. 10)'),

                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(3)
                            ->placeholder('Optional: dimensions, material, etc.'),
                    ]),

                Section::make('MOQ Tier Pricing (Per Box)')
                    ->description('Box customization cost per unit — decreases with higher quantity')
                    ->columns(2)
                    ->schema([
                        TextInput::make('price_tier1')
                            ->label('50–99 pcs (Rs.)')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0),

                        TextInput::make('price_tier2')
                            ->label('100–199 pcs (Rs.)')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0),

                        TextInput::make('price_tier3')
                            ->label('200–499 pcs (Rs.)')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0),

                        TextInput::make('price_tier4')
                            ->label('500+ pcs (Rs.)')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0),
                    ]),

                Section::make('Visibility & Order')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active (available for selection)')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower number = shown first (smallest box first)'),
                    ]),

                Section::make('Box Image')
                    ->schema([
                        FileUpload::make('box_images')
                            ->label('Box Photo')
                            ->image()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload box photo shown to clients (max 2MB)')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
