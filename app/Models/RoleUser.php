<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    public const TABLE = 'role_user';

    public const ROLE_ID = 'role_id';
    public const USER_ID = 'user_id';
}
