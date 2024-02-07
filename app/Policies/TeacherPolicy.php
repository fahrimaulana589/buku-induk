<?php

namespace App\Policies;

use App\Models\Clas;
use App\Models\Teacher;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class TeacherPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('teacher.update');
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

        return $result;
    }
}
