<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role->role == 'administrator';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NewsController  $newsController
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, News $news)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role->role == 'administrator';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NewsController  $newsController
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, News $news)
    {
        return $user->role->role == 'administrator';
    }

    public function delete(User $user, News $news)
    {
        return $user->role->role == 'administrator';
    }
}
