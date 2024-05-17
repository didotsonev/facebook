<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function testBelongsToManyUsers()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create();

        $role->users()->attach($user->{User::ID});

        $this->assertTrue($role->users->contains($user));
    }
}
