<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        return $user->isAdmin() or ($user->isUser() and $user->id === $post->user_id) or $post->hidden_status != true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isUser();
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->isUser() and $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->isAdmin() or ($user->isUser() and $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        return $user->isAdmin();
    }

    public function hide(User $user, Post $post)
    {
        return $user->isAdmin() or ($user->isUser() and $user->id === $post->user_id);
    }

    public function unHide(User $user, Post $post)
    {
        return $user->isAdmin() or ($user->isUser() and $user->id === $post->user_id);
    }

    public function report(User $user, Post $post)
    {
        return $user->isUser() and $user->id !== $post->user_id ;
    }

    public function unReport(User $user, Post $post)
    {
        return $user->isAdmin();
    }

    public function view_all(User $user)
    {
        return $user->isUser();
    }
}
