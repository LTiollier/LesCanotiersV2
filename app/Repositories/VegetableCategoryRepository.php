<?php

namespace App\Repositories;

use App\Models\VegetableCategory;

class VegetableCategoryRepository
{
    public function __construct(private VegetableCategory $model)
    {
    }

    /**
     * @param array<string> $relations
     * @return \Illuminate\Support\Collection
     */
    public function all(array $relations = []): \Illuminate\Support\Collection
    {
        return $this->model
            ->with($relations)
            ->get();
    }

    /**
     * @param array<mixed> $parameters
     * @return VegetableCategory
     */
    public function store(array $parameters): VegetableCategory
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save();

        return $model;
    }

    /**
     * @param VegetableCategory $vegetableCategory
     * @param array<mixed> $parameters
     * @return VegetableCategory
     */
    public function update(VegetableCategory $vegetableCategory, array $parameters): VegetableCategory
    {
        $vegetableCategory
            ->fill($parameters)
            ->save();

        return $vegetableCategory;
    }

    /**
     * @throws \Exception
     */
    public function delete(VegetableCategory $vegetableCategory): bool
    {
        return (bool) $vegetableCategory->delete();
    }
}
