<?php

namespace App\Policies;

use App\Models\SchoolYear;
use App\Models\Teacher;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class SchoolYearPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('schoolYear.view');
    }

    public function delete(Model $user, SchoolYear $schoolYear): bool
    {
        $result = true;

        if($schoolYear->lulusan()->count() > 0){
            $result = false;
        };

        if($schoolYear->keluar()->count() > 0){
            $result = false;
        };

        if($schoolYear->reports()->count() > 0){
            $result = false;
        };

        if(!$user->can('schoolYear.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user)
    {
        $result = true;

        if(!$user->can('schoolYear.update')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('schoolYear.update')){
            $result = false;
        };

        return $result;
    }
}
