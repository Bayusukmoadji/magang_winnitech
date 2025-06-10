<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ReplyNews;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyNewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_reply::news');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ReplyNews $replyNews): bool
    {
        return $user->can('view_reply::news');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_reply::news');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ReplyNews $replyNews): bool
    {
        return $user->can('update_reply::news');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ReplyNews $replyNews): bool
    {
        return $user->can('delete_reply::news');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_reply::news');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ReplyNews $replyNews): bool
    {
        return $user->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ReplyNews $replyNews): bool
    {
        return $user->can('{{ Restore }}');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ReplyNews $replyNews): bool
    {
        return $user->can('{{ Replicate }}');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }
}
