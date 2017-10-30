<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UsersPolicy
 *
 * @package App\Policies
 */
class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $authUser  The data form the authenticated User.
     * @param  \App\User  $userDb    The data from the database record.
     * @return mixed
     */
    public function delete(User $authUser, User $userDb)
    {
        return $authUser->id == $userDb->id || $authUser->hasRole('admin');
    }
}
