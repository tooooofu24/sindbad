<?php

namespace App\Policies;

use App\Models\Report;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ReportPolicy
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
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Report  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Model $user, Report $policy)
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
     * @param  \App\Models\Report  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Model $user, Report $policy)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Report  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Model $user, Report $policy)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Report  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Model $user, Report $policy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Model  $user
     * @param  \App\Models\Report  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Model $user, Report $policy)
    {
        //
    }
}
