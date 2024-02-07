<?php

namespace App\Policies;

use App\Models\Clas;
use App\Models\Evaluasi;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class EvaluasiPolicy
{
    use HandlesAuthorization;


    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('evaluasi.update');
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

        return $result;
    }
}
