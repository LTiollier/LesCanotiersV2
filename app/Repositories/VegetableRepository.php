<?php

namespace App\Repositories;

use App\Models\Vegetable;
use Illuminate\Support\Collection;

class VegetableRepository
{
    public function __construct(private Vegetable $model)
    {
    }

    public function all(array $relations = []): Collection
    {
        return $this->model
            ->with($relations)
            ->get();
    }

    public function store(array $parameters): Vegetable
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save();

        return $model;
    }

    public function update(Vegetable $vegetable, array $parameters): Vegetable
    {
        $vegetable
            ->fill($parameters)
            ->save();

        return $vegetable;
    }

    public function delete(Vegetable $vegetable): bool
    {
        return (bool) $vegetable->delete();
    }
}
