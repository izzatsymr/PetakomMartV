<?php

namespace App\Policies;

use App\Models\Cash;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the cash can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allcash');
    }

    /**
     * Determine whether the cash can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cash  $model
     * @return mixed
     */
    public function view(User $user, Cash $model)
    {
        return $user->hasPermissionTo('view allcash');
    }

    /**
     * Determine whether the cash can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allcash');
    }

    /**
     * Determine whether the cash can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cash  $model
     * @return mixed
     */
    public function update(User $user, Cash $model)
    {
        return $user->hasPermissionTo('update allcash');
    }

    /**
     * Determine whether the cash can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cash  $model
     * @return mixed
     */
    public function delete(User $user, Cash $model)
    {
        return $user->hasPermissionTo('delete allcash');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cash  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allcash');
    }

    /**
     * Determine whether the cash can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cash  $model
     * @return mixed
     */
    public function restore(User $user, Cash $model)
    {
        return false;
    }

    /**
     * Determine whether the cash can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cash  $model
     * @return mixed
     */
    public function forceDelete(User $user, Cash $model)
    {
        return false;
    }
}
