<?php
// app/Policies/PostPolicy.php

namespace App\Policies;

class PostPolicy
{
    public function view($user)
    {
        return $user->role === 'editor' || $user->role === 'admin';
    }

    public function viewDetail($user, $post)
    {
        return $user->role === 'admin' || ($user->role === 'editor' && $post->user_id === $user->id);
    }

    public function update($user, $post)
    {
        if ($user->role === 'admin') {
            return true;
        } elseif ($user->role === 'editor') {
            return $post->user_id == $user->id;
        } else {
            return false;
        }
    }

    public function create($user)
    {
        return $user->role === 'admin' || $user->role === 'editor';
    }

    public function delete($user, $post)
    {
        return $user->role === 'admin' || ($user->role === 'editor' && $post->user_id === $user->id);
    }
}
