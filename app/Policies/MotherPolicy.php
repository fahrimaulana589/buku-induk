<?php

namespace App\Policies;

use App\Models\Mother;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class MotherPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('mother.view');
    }

    public function delete(Model $user, Mother $mother): bool
    {
        $result = true;
        if ($mother->students->count() > 0){
            $result = false;
        }

        if(!$user->can('mother.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user)
    {
        $result = true;

        if(!$user->can('mother.update')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('mother.update')){
            $result = false;
        };

        return $result;
    }

}
