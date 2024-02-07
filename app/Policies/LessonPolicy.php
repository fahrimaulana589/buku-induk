<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class LessonPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('lesson.update');
    }

    public function delete(Model $user, Lesson $lesson): bool
    {
        $result = true;
        if($lesson->clas()->count() > 0){
            $result = false;
        };
        if($lesson->reports()->count() > 0){
            $result = false;
        };
        return $result;
    }
}
