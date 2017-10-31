<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class BlockPolicy
 *
 * @package App\Policies
 */
class BlockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can blockuser in the database.
     *
     * @param  \App\User  $user     The authenticated user.
     * @param  \App\User  $model    The user from the database.
     * @return mixed
     */
    public function block(User $user, User $model)
    {
        return $user->id != $model->id && $user->hasRole('admin');
    }
}
