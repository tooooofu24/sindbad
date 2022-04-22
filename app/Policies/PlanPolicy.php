<?php

namespace App\Policies;

use App\Models\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class PlanPolicy
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
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Model $user, Plan $plan)
    {
        return $plan->public_flag == true || $plan->user_id == $user->id;
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
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Model $user, Plan $plan)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $plan->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Model $user, Plan $plan)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $plan->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Model $user, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Model $user, Plan $plan)
    {
        //
    }
}
