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
        return $user->can('lesson.view');
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

        if(!$user->can('lesson.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user)
    {
        $result = true;

        if(!$user->can('lesson.update')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('lesson.update')){
            $result = false;
        };

        return $result;
    }
}
