<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class TestPolicy
{
    use HandlesAuthorization;

    public function viewAny(FilamentUser $user): bool
    {
        return $user->can('test.view') | $user->can('report.view');
    }

    public function view(FilamentUser $user)
    {
        return true;
    }

    public function delete(FilamentUser $user, Test $test): bool
    {
        $result = true;

        if ($test->reports()->count() > 0) {
            $result = false;
        };

        if (!$user->can('test.update')) {
            $result = false;
        };

        return $result;
    }

    public function update(FilamentUser $user)
    {
        $result = true;

        if (!$user->can('test.update')) {
            $result = false;
        };

        return $result;
    }

    public function create(FilamentUser $user): bool
    {
        $result = true;

        if (!$user->can('test.update')) {
            $result = false;
        };

        return $result;
    }

}
