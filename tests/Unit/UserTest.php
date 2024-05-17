<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testBelongsToManyRoles()
    {
        // create user
        $user = User::factory()->create();
        $role1 = Role::factory()->create([
            Role::TITLE => 'admin1',
        ]);
        $role2 = Role::factory()->create([
            Role::TITLE => 'admin2',
        ]);

        // add new role manually
//        DB
//            ::table('role_user')
//            ->insert([
//                'role_id' => $role->{Role::ID},
//                'user_id' => $user->{User::ID},
//            ]);

        // attach only
        $user->roles()->attach([
            $role1->{Role::ID},
            $role2->{Role::ID},
        ]);

        // detach only
//        $user->roles()->detach($role1->{Role::ID});
        // apply passed only (overwrite all existing roles)
//        $user->roles()->sync($role3->{Role::ID});
        // apply passed only (add non existing roles only)
//        $user->roles()->syncWithoutDetaching(3);

        // reload user roles
        $user->refresh();
        $this->assertTrue($user->roles->contains($role1));
    }

    public function testHasManyPosts()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->posts);
        $this->assertTrue($user->posts->isEmpty());

        $postA = Post::factory()->createdBy($user)->archived()->create();
//        $posts = Post::factory()->createdBy($user)->count(3)->create();
//        $postA1 = $user->posts()->create([
//            Post::DESCRIPTION => 'Post A1',
//        ]);
//        $postA1 = $user->posts()->create(Post::factory()->raw());
//        $posts = $user->posts()->createMany([
//            Post::factory()->raw(),
//            Post::factory()->raw(),
//        ]);
//        $posts = $user->posts()->createMany(Post::factory()->count(3)->raw());

        $postB = Post::factory()->createdBy($user)->create();
        $otherUserPost = Post::factory()->createdBy($otherUser)->create();

        $user->refresh();

        $this->assertTrue($user->posts->contains($postA));
        $this->assertTrue($user->posts->contains($postB));
        $this->assertFalse($user->posts->contains($otherUserPost));
    }
}
