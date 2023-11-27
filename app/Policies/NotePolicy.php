<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Note $note): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Note $note): bool
    {
    }

    public function delete(User $user, Note $note): bool
    {
    }

    public function restore(User $user, Note $note): bool
    {
    }

    public function forceDelete(User $user, Note $note): bool
    {
    }
}
