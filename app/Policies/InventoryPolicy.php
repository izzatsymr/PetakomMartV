<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the inventory can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list inventories');
    }

    /**
     * Determine whether the inventory can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inventory  $model
     * @return mixed
     */
    public function view(User $user, Inventory $model)
    {
        return $user->hasPermissionTo('view inventories');
    }

    /**
     * Determine whether the inventory can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create inventories');
    }

    /**
     * Determine whether the inventory can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inventory  $model
     * @return mixed
     */
    public function update(User $user, Inventory $model)
    {
        return $user->hasPermissionTo('update inventories');
    }

    /**
     * Determine whether the inventory can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inventory  $model
     * @return mixed
     */
    public function delete(User $user, Inventory $model)
    {
        return $user->hasPermissionTo('delete inventories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inventory  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete inventories');
    }

    /**
     * Determine whether the inventory can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inventory  $model
     * @return mixed
     */
    public function restore(User $user, Inventory $model)
    {
        return false;
    }

    /**
     * Determine whether the inventory can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inventory  $model
     * @return mixed
     */
    public function forceDelete(User $user, Inventory $model)
    {
        return false;
    }
}
