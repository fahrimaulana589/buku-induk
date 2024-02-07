<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class TestPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('lesson.update');
    }

    public function delete(Model $user, Test $test): bool
    {
        $result = true;

        if($test->reports()->count() > 0){
            $result = false;
        };

        return $result;
    }

}
