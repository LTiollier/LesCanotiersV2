<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasRole(User::ADMIN_ROLE);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(User::ADMIN_ROLE);
    }

    public function store(User $user): bool
    {
        return $user->hasRole(User::ADMIN_ROLE);
    }

    public function edit(User $user, User $userParam): bool
    {
        if ($user->hasRole(User::ADMIN_ROLE)) {
            return true;
        }

        return $user->getKey() === $userParam->getKey();
    }

    public function update(User $user, User $userParam): bool
    {
        if ($user->hasRole(User::ADMIN_ROLE)) {
            return true;
        }

        return $user->getKey() === $userParam->getKey();
    }

    public function delete(User $user, User $userParam): bool
    {
        if ($user->hasRole(User::ADMIN_ROLE)) {
            return true;
        }

        return $user->getKey() === $userParam->getKey();
    }
}
