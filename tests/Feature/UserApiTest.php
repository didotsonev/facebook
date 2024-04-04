<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    protected function indexRoute(): string
    {
        return route('api.users.index');
    }

    protected function storeRoute(): string
    {
        return route('api.users.store');
    }

    public function testIndex()
    {
        $url = $this->indexRoute();
        $user = User::factory()->create();

        $this
            ->getJson($url)
            ->assertStatus(200)
            ->assertSee($user->{User::NAME});
    }

    public function testStore()
    {
        $data = User::factory()->raw();
        $url = $this->storeRoute();

        $this
            ->postJson($url, $data)
            ->assertCreated()
            ->assertSee($data[User::NAME]);

        $this->assertDatabaseHas(User::TABLE, [
            User::NAME => $data[User::NAME],
            User::EMAIL => $data[User::EMAIL],
        ]);
    }

    
}
