<?php

namespace App\Policies;

use App\Models\Clas;
use App\Models\Evaluasi;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class EvaluasiPolicy
{
    use HandlesAuthorization;


    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('evaluasi.view') | $user->can('report.view');
    }

    public function delete(Model $user, Evaluasi $evaluasi)
    {
        $result = true;

        if ($evaluasi->reports->count() > 0){
            $result = false;
        }

        if ($evaluasi->evaluasis->count() > 0){
            $result = false;
        }

        if(!$user->can('evaluasi.update')){
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user)
    {
        $result = true;

        if(!$user->can('evaluasi.update')){
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if(!$user->can('evaluasi.update')){
            $result = false;
        };

        return $result;
    }
}
