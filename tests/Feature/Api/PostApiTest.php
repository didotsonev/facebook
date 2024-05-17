<?php

namespace Tests\Feature\Api;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    private function indexRoute(): string
    {
        return route('api.posts.index');
    }
    private function showRoute($id): string
    {
        return route('api.posts.show', ['post' => $id]);
    }

    public function testIndexUserCanViewPosts()
    {
        $user = User::factory()->create();
        $count = random_int(1, 9);
        Post::factory()->createdBy($user)->count($count)->create();

        $otherUser = User::factory()->create();
        Post::factory()->createdBy($otherUser)->create();

        $url = $this->indexRoute() . "?createdById=" . $user->{User::ID};

        $this
            ->getJson($url)
            ->assertOk()
            ->assertJsonCount($count, 'data');
    }

    public function testUserCanViewPost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->createdBy($user)->create();

        $url = $this->showRoute($post->{Post::ID});

        $this
            ->getJson($url)
            ->assertOk()
            ->assertSee($post->{Post::DESCRIPTION});
    }
}
