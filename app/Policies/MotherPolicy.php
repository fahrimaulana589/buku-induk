<?php

namespace App\Policies;

use App\Models\Mother;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class MotherPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('mother.update');
    }

    public function delete(Model $user, Mother $mother): bool
    {
        $result = true;
        if ($mother->students->count() > 0){
            $result = false;
        }
        return $result;
    }

}
