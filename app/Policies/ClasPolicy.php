<?php

namespace App\Policies;

use App\Models\Clas;
use App\Models\Father;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class ClasPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('class.update');
    }

    public function delete(Model $user, Clas $class)
    {
        $result = true;
        if ($class->students->count() > 0){
            $result = false;
        }

        if ($class->reports->count() > 0){
            $result = false;
        }

        if ($class->lessons->count() > 0){
            $result = false;
        }
        return $result;
    }
}
