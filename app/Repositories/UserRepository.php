<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    public function __construct(private User $model)
    {
    }

    public function all(array $relations = []): Collection
    {
        return $this->model
            ->with($relations)
            ->get()
        ;
    }

    public function store(array $parameters): User
    {
        $parameters['password'] = bcrypt($parameters['password']);

        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save()
        ;

        if (!empty($parameters['role'])) {
            $model->assignRole($parameters['role']);
        }

        return $model;
    }

    public function update(User $user, array $parameters): User
    {
        $parameters['password'] = bcrypt($parameters['password']);

        $user
            ->fill($parameters)
            ->save()
        ;

        if (!empty($parameters['role'])) {
            $user->assignRole($parameters['role']);
        }

        return $user;
    }

    public function delete(User $user): bool
    {
        return (bool) $user->delete();
    }
}
