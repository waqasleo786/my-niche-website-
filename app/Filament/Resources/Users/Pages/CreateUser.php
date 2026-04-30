<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $giftBuilderAccess = $this->data['gift_builder_access'] ?? false;

        if ($giftBuilderAccess) {
            $this->record->givePermissionTo('view_gift_builder');
        }
    }
}
