<?php

namespace App\Policies;

use App\Models\Father;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class FatherPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('father.update');
    }
    public function delete(Model $user, Father $father): bool
    {
        $result = true;
        if ($father->students->count() > 0){
            $result = false;
        }
        return $result;
    }
}
