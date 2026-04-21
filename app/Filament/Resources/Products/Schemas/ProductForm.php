<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Product Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, callable $set) =>
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            ),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('category_id')
                            ->label('Category')
                            ->options(Category::where('is_active', true)->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('sku')
                            ->label('SKU')
                            ->maxLength(100)
                            ->helperText('Leave blank to auto-generate'),

                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(4),
                    ]),

                Section::make('Pricing & Stock')
                    ->columns(2)
                    ->schema([
                        TextInput::make('price')
                            ->label('B2C Price (PKR)')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0),

                        TextInput::make('b2b_price')
                            ->label('B2B Price (PKR)')
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0)
                            ->helperText('Leave blank to use B2C price for B2B too'),

                        TextInput::make('min_b2b_quantity')
                            ->label('Min B2B Order Qty')
                            ->numeric()
                            ->default(10)
                            ->minValue(1),

                        TextInput::make('stock_quantity')
                            ->label('Stock Quantity')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ]),

                Section::make('Visibility')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active (visible on storefront)')
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label('Featured (show on homepage)')
                            ->default(false),
                    ]),

                Section::make('Product Images')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Product Images')
                            ->multiple()
                            ->image()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload product images (max 2MB each). First image = main image.')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
