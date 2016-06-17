<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\UserFile;

class UserFilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  UserFile  $file
     * @return bool
     */
    public function destroy(User $user, UserFile $file)
    {
        return $user->id === $file->user_id;
    }
}
