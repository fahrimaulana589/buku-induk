<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function view(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('report.view')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('report.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('report.update')){
            $result = false;
        };

        return $result;
    }
}
