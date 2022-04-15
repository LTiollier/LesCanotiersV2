<?php

namespace App\Policies;

use App\Models\Time;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function store(User $user, array $data): bool
    {
        if ($user->hasRole(User::ADMIN_ROLE)) {
            return true;
        }

        return $user->getKey() === data_get($data, 'user_id');
    }

    public function edit(User $user, Time $time): bool
    {
        if ($user->hasRole(User::ADMIN_ROLE)) {
            return true;
        }

        return $user->getKey() === $time->user_id;
    }

    public function update(User $user, Time $time, array $data): bool
    {
        if ($user->hasRole(User::ADMIN_ROLE)) {
            return true;
        }

        return $user->getKey() === $time->user_id;
    }

    public function delete(User $user, Time $time): bool
    {
        if ($user->hasRole(User::ADMIN_ROLE)) {
            return true;
        }

        return $user->getKey() === $time->user_id;
    }
}
