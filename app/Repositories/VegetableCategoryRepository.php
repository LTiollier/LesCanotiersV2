<?php

namespace App\Repositories;

use App\Models\VegetableCategory;
use Illuminate\Support\Collection;

class VegetableCategoryRepository
{
    public function __construct(private VegetableCategory $model)
    {
    }

    public function all(array $relations = []): Collection
    {
        return $this->model
            ->with($relations)
            ->get();
    }

    public function store(array $parameters): VegetableCategory
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save();

        return $model;
    }

    public function update(VegetableCategory $vegetableCategory, array $parameters): VegetableCategory
    {
        $vegetableCategory
            ->fill($parameters)
            ->save();

        return $vegetableCategory;
    }

    public function delete(VegetableCategory $vegetableCategory): bool
    {
        return (bool) $vegetableCategory->delete();
    }
}
