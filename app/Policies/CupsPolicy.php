<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cups;
use Illuminate\Auth\Access\HandlesAuthorization;

class CupsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_cups');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cups $cups): bool
    {
        return $user->can('view_cups');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_cups');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cups $cups): bool
    {
        return $user->can('update_cups');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cups $cups): bool
    {
        return $user->can('delete_cups');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_cups');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Cups $cups): bool
    {
        return $user->can('force_delete_cups');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_cups');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Cups $cups): bool
    {
        return $user->can('restore_cups');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_cups');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Cups $cups): bool
    {
        return $user->can('replicate_cups');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_cups');
    }
}
