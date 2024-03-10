<?php

namespace App\Policies;

use App\Models\Clas;
use App\Models\Teacher;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class TeacherPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('teacher.view');
    }
    public function delete(Model $user, Teacher $teacher): bool
    {
        $result = true;

        if($teacher->classes()->count() > 0){
            $result = false;
        };

        if($teacher->lessons()->count() > 0){
            $result = false;
        };

        if(!$user->can('teacher.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user)
    {
        $result = true;

        if(!$user->can('teacher.update')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('teacher.update')){
            $result = false;
        };

        return $result;
    }
}
