<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class ReportPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('report.view');
    }

    public function delete(Model $user, Report $report)
    {
        $result = true;
        if ($report->values->count() > 0){
            $result = false;
        }

        if ($report->evaluasis->count() > 0){
            $result = false;
        }

        if ($report->notes->count() > 0){
            $result = false;
        }

        if(!$user->can('report.delete')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('report.create')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('report.update')){
            $result = false;
        };

        if($user->isTeacher()){
            $result = true;
        };

        return $result;
    }
}
