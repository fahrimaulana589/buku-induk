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
        return $user->can('schoolYear.update');
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

        return $result;
    }
}
