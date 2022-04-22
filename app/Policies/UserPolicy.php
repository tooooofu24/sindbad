<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Model  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Model $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Model $user, Model $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Model  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Model $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Model $user, Model $model)
    {
        if ($user->isAdmin()) {
            return true;
        }
        $user->id == $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Model $user, Model $model)
    {
        if ($user->isAdmin()) {
            return true;
        }
        $user->id == $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Model $user, Model $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Model $user, Model $model)
    {
        //
    }
}
