<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class LessonPolicy
{
    use HandlesAuthorization;

    public function delete(Model $user, Lesson $lesson): bool
    {
        $result = true;
        if($lesson->clas()->count() > 0){
            $result = false;
        };
        return $result;
    }
}
