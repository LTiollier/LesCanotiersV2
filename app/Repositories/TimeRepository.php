<?php

namespace App\Repositories;

use App\Models\Time;
use Illuminate\Support\Collection;

class TimeRepository
{
    public function __construct(private Time $model)
    {
    }

    public function all(array $relations = []): Collection
    {
        return $this->model
            ->with($relations)
            ->get();
    }

    public function store(array $parameters): Time
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save();

        return $model;
    }

    public function update(Time $time, array $parameters): Time
    {
        $time
            ->fill($parameters)
            ->save();

        return $time;
    }

    /**
     * @throws \Exception
     */
    public function delete(Time $time): bool
    {
        return (bool) $time->delete();
    }
}
