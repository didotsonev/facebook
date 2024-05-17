<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    public const TABLE = 'roles';

    public const ID = 'id';
    public const TITLE = 'title';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $guarded = [
        self::ID
    ];

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                User::class,
                RoleUser::TABLE,
                RoleUser::ROLE_ID,
                RoleUser::USER_ID,
                self::ID,
                User::ID
            );
    }
}
