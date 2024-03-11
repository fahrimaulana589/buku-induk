<?php

namespace App\Policies;

use App\Models\Clas;
use App\Models\Father;
use App\Models\FilamentUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class ClasPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('class.view')  | $user->can('report.view');
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

        if(!$user->can('class.update')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('class.update')){
            $result = false;
        };

        return $result;
    }
}
