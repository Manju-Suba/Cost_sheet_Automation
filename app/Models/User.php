<?php

namespace App\Models;
use App\Models\Role;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'current_role_id'
    ];

    // ...

    const ROLE_PMPURCHASE = 'PM Purchase';
    const ROLE_RMPURCHASE = 'RM Purchase';

    // ...

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
