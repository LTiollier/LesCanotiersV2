<?php

namespace App\Repositories;

use App\Models\Parcel;
use Illuminate\Support\Collection;

class ParcelRepository
{
    public function __construct(private Parcel $model)
    {
    }

    public function all(array $relations = []): Collection
    {
        return $this->model
            ->with($relations)
            ->get();
    }

    public function store(array $parameters): Parcel
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save();

        return $model;
    }

    public function update(Parcel $parcel, array $parameters): Parcel
    {
        $parcel
            ->fill($parameters)
            ->save();

        return $parcel;
    }

    public function delete(Parcel $parcel): bool
    {
        return (bool) $parcel->delete();
    }
}
