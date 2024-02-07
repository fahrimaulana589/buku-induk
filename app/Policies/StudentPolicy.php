<?php

namespace App\Policies;

use App\Models\Mother;
use App\Models\Student;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class StudentPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('student.update');
    }

    public function delete(Model $user, Student $student): bool
    {
        $result = true;
        if ($student->guardian()->exists()){
            $result = false;
        }

        if ($student->reports()->count() > 0){
            $result = false;
        }

        return $result;
    }
}
