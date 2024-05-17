<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const TABLE = 'users';

    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = self::TABLE;
    protected $guarded = [
        'id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Role::class,
                RoleUser::TABLE,
                RoleUser::USER_ID,
                RoleUser::ROLE_ID,
                self::ID,
                Role::ID
            );
    }

    public function posts(): HasMany
    {
        return $this
            ->hasMany(
                Post::class,
                Post::CREATED_BY_ID,
                self::ID
            );
    }
}
