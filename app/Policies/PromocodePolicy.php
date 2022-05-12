<?php

namespace App\Policies;

use App\Models\Promocode;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromocodePolicy
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
        return $user->hasPermissionTo('promocodes.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Promocode $promocode)
    {
        return $user->hasPermissionTo('promocodes.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('promocodes.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Promocode $promocode)
    {
        return $user->hasPermissionTo('promocodes.update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Promocode $promocode)
    {
        return $user->hasPermissionTo('promocodes.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Promocode $promocode)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Promocode $promocode)
    {
        //
    }
}
