<?php

namespace App\Policies;

use App\Models\Father;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class FatherPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('father.view');
    }
    public function delete(Model $user, Father $father): bool
    {
        $result = true;
        if ($father->students->count() > 0){
            $result = false;
        }

        if(!$user->can('father.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user)
    {
        $result = true;

        if(!$user->can('father.update')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('father.update')){
            $result = false;
        };

        return $result;
    }
}
