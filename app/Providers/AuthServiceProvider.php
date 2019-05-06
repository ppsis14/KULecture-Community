<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Post;
use App\User;
use App\UserProfile;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => 'App\Policies\PostPolicy',
        UserProfile::class => 'App\Policies\UserProfilePolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        GATE::define('isAdmin',function($user){
            return $user->role === "ADMINISTRATOR";
        });

        GATE::define('isUser',function($user){
            return $user->role === "USER";
        });
    }
}
