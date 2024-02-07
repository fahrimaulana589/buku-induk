<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class ReportPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('report.update');
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
        return $result;
    }
}
