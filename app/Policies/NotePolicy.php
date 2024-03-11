<?php

namespace App\Policies;

use App\Models\Mother;
use App\Models\Note;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class NotePolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        $result = false;

        if($user->can('report.update')|$user->isTeacher()){
            $result = true;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = false;

        if($user->can('report.update')|$user->isTeacher()){
            $result = true;
        };

        return $result;
    }

    public function update(FilamentUser $user): bool
    {
        $result = false;

        if($user->can('report.update')|$user->isTeacher()){
            $result = true;
        };

        return $result;
    }
    public function delete(Model $user): bool
    {
        $result = false;

        if($user->can('report.delete')|$user->isTeacher()){
            $result = true;
        };

        return $result;
    }
}
