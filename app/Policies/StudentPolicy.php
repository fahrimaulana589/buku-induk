<?php

namespace App\Policies;

use App\Models\Mother;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class StudentPolicy
{
    use HandlesAuthorization;

    public function delete(Model $user, Student $student): bool
    {
        $result = true;
        if ($student->guardian()->exists()){
            $result = false;
        }
        return $result;
    }
}
