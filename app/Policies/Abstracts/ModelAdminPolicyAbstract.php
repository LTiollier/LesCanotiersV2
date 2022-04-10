<?php

namespace App\Policies\Abstracts;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

abstract class ModelAdminPolicyAbstract
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

    public function edit(User $user, Model $model): bool
    {
        return $user->hasRole(User::ADMIN_ROLE);
    }

    public function update(User $user, Model $model): bool
    {
        return $user->hasRole(User::ADMIN_ROLE);
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->hasRole(User::ADMIN_ROLE);
    }
}
