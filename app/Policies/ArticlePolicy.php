<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return !empty($user);
    }

    public function update(User $user, Article $article)
    {
        return $article->owner_id == $user->id || $user->role->role == 'administrator';
    }
    
    public function adminPages(User $user)
    {
        return $user->role->role == 'administrator';
    }
}
