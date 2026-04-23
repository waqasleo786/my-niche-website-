<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactSubmissions;

use App\Filament\Resources\ContactSubmissions\Pages\ListContactSubmissions;
use App\Filament\Resources\ContactSubmissions\Tables\ContactSubmissionsTable;
use App\Models\ContactSubmission;
use BackedEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static UnitEnum|string|null $navigationGroup = 'Support';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?string $pluralModelLabel = 'Contact Messages';

    protected static ?string $modelLabel = 'Contact Message';

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name')->label('Name'),
            TextEntry::make('email')->label('Email')->copyable(),
            TextEntry::make('phone')->label('Phone')->placeholder('Not provided'),
            TextEntry::make('subject')->label('Subject')->columnSpanFull(),
            TextEntry::make('message')->label('Message')->columnSpanFull(),
            TextEntry::make('created_at')->label('Received')->dateTime('d M Y, h:i A'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return ContactSubmissionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactSubmissions::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
