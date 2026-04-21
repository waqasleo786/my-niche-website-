<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use HasRoles;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'company_name',
        'ntn_number',
        'is_b2b',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_b2b'            => 'boolean',
            'is_verified'       => 'boolean',
        ];
    }

    // -------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    // -------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------

    public function isB2bVerified(): bool
    {
        return $this->is_b2b && $this->is_verified;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    // -------------------------------------------------------------------
    // Filament
    // -------------------------------------------------------------------

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }
}
