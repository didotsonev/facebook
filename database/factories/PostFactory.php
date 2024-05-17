<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            Post::DESCRIPTION => $this->faker->sentence(12),
            // needs preseeded user with id 1
//            Post::CREATED_BY_ID => 1,
            // creates a new user and assigns the id
//            Post::CREATED_BY_ID => User::factory()->create()->{User::ID}
        ];
    }

    public function createdBy(User $user): Factory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                Post::CREATED_BY_ID => $user->{User::ID},
            ];
        });
    }
}
