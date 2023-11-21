<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can update the model.
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        if( ! $user->can('edit-user')) {
            return false;
        }

        if($user->id !== $model->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        if( ! $user->can('delete-user')) {
            return false;
        }

        if($user->id !== $model->id) {
            return false;
        }

        return true;
    }
}
