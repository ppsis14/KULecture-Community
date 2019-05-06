<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\UserProfile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->state('ADMINISTRATOR')->create();
        factory(User::class,10)->state('USER')->create()->each(function ($user) {
            $user->posts()->saveMany(
                factory(Post::class, 50)->make()
            );
            $user->profile()->save(
                factory(UserProfile::class)->make()
            );
        });
    }
}
