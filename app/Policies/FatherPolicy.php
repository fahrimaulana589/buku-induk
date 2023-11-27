<?php

namespace App\Policies;

use App\Models\Father;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class FatherPolicy
{
    use HandlesAuthorization;


    public function delete(Model $user, Father $father): bool
    {
        $result = true;
        if ($father->students->count() > 0){
            $result = false;
        }
        return $result;
    }
}
