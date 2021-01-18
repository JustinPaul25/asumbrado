<?php

namespace App;

use App\Types\RoleType;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleType::ADMINISTRATOR);
    }

    public function isMid(): bool
    {
        return $this->hasRole(RoleType::MID);
    }

    public function isViewOnly(): bool
    {
        return $this->hasRole(RoleType::VIEWONLY);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
