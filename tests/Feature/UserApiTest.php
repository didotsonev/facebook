<?php

namespace Tests\Feature;

use App\Http\Requests\UserIndexRequest;
use App\Models\User;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    protected function indexRoute(array $queryParameters = []): string
    {
        return route('api.users.index', $queryParameters);
    }

    protected function storeRoute(): string
    {
        return route('api.users.store');
    }

    protected function showRoute($userId): string
    {
        return route('api.users.show', $userId);
    }

    protected function updateRoute($userId): string
    {
        return route('api.users.update', $userId);
    }

    protected function destroyRoute($userId): string
    {
        return route('api.users.destroy', $userId);
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

    // /api/users?whereEmail=test@aa.aa
    public function testIndexCanFilterByWhereEmail()
    {
        // user with different email
        // user with exact email
        $userWithDifferentEmail = User::factory()->create();
        $userWithExactEmail = User::factory()->create();

        $url = $this->indexRoute([
            UserIndexRequest::WHERE_EMAIL => $userWithExactEmail->{User::EMAIL},
        ]);

        $this
            ->getJson($url)
            ->assertOk()
            ->assertSee($userWithExactEmail->{User::NAME})
            ->assertDontSee($userWithDifferentEmail->{User::NAME})
            ->assertJsonCount(1);
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

    public function testStoreValidateNameIsRequired()
    {
        $data = User::factory()->raw();
        unset($data[User::NAME]);
        $url = $this->storeRoute();

        $this
            ->postJson($url, $data)
            ->assertUnprocessable() // status code 422
            ->assertInvalid(User::NAME);
    }

    public function testStoreValidateNameIsString()
    {
        $data = User::factory()->raw([
            User::NAME => 123,
        ]);
        $url = $this->storeRoute();

        $this
            ->postJson($url, $data)
            ->assertUnprocessable() // status code 422
            ->assertInvalid(User::NAME);
    }

    public function testStoreValidateNameHasMaxLength()
    {
        $data = User::factory()->raw([
            User::NAME => str_repeat('a', 256),
        ]);
        $url = $this->storeRoute();

        $this
            ->postJson($url, $data)
            ->assertUnprocessable() // status code 422
            ->assertInvalid(User::NAME);
    }

    public function testStoreValidateEmailIsUnique()
    {
        $user = User::factory()->create();
        $data = User::factory()->raw([
            User::EMAIL => $user->{User::EMAIL},
        ]);
        $url = $this->storeRoute();

        $this
            ->postJson($url, $data)
            ->assertUnprocessable()
            ->assertInvalid(User::EMAIL);
    }

    public function testUpdateValidateNameIsRequired()
    {
        $user = User::factory()->create();
        $data = User::factory()->raw();
        unset($data[User::NAME]);

        $url = $this->updateRoute($user->{User::ID});
        $this
            ->putJson($url, $data)
            ->assertUnprocessable()
            ->assertInvalid(User::NAME);
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $url = $this->showRoute($user->{User::ID});

        $this
            ->getJson($url)
            ->assertOk()
            ->assertSee($user->{User::NAME})
            ->assertSee($user->{User::EMAIL});
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $url = $this->updateRoute($user->{User::ID});
        $data = User::factory()->raw();

        $this
            ->putJson($url, $data)
            ->assertOk()
            ->assertSee($data[User::NAME])
            ->assertSee($data[User::EMAIL]);

        $this->assertDatabaseHas(User::TABLE, [
            User::ID => $user->{User::ID},
            User::NAME => $data[User::NAME],
            User::EMAIL => $data[User::EMAIL],
        ]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $url = $this->destroyRoute($user->{User::ID});

        $this
            ->deleteJson($url)
            ->assertOk()
            ->assertSee($user->{User::NAME})
            ->assertSee($user->{User::EMAIL});
    }
}
