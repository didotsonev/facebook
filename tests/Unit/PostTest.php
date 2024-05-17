<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testBelongsToCreatedBy()
    {
        $user = User::factory()->create();
        $post = Post::factory()->createdBy($user)->create();

        $this->assertInstanceOf(User::class, $post->createdBy);
        $this->assertTrue($post->createdBy->is($user));
    }
}
