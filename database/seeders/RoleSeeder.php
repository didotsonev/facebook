<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            Role::TITLE => 'admin',
        ]);

        Role::factory()->create([
            Role::TITLE => 'user',
        ]);

        Role::factory()->create([
            Role::TITLE => 'moderator',
        ]);
    }
}
