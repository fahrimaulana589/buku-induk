<?php

namespace App\Policies;

use App\Models\Guardian;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuardPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('guard.view')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('guard.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user, Guardian $guardian): bool
    {

        $result = true;

        if(!$user->can('guard.update')){
            $result = false;
        };

        return $result;
    }

    public function delete(FilamentUser $user, Guardian $guardian): bool
    {

        $result = true;

        if(!$user->can('guard.update')){
            $result = false;
        };

        return $result;
    }

}
