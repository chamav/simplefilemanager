<?php

namespace App\Repositories;

use App\User;

class FileRepository
{
    /**
     * Get all of the files for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->files()
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'asc')
            ->get();
    }
}