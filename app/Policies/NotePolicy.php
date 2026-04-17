<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    /**
     * Grant all abilities to admin users.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any notes (list all their notes).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view a specific note.
     * Only the owner can view their note.
     */
    public function view(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

    /**
     * Determine whether the user can create a note.
     * Any authenticated user can create a note.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update a note.
     * Only the owner can update their note.
     */
    public function update(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

    /**
     * Determine whether the user can delete a note.
     * Only the owner can delete their note.
     */
    public function delete(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

    /**
     * Determine whether the user can restore a note.
     * Not allowed for any user.
     */
    public function restore(User $user, Note $note): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete a note.
     * Not allowed for any user.
     */
    public function forceDelete(User $user, Note $note): bool
    {
        return false;
    }
}
