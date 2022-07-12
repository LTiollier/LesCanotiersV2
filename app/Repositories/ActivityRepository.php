<?php

namespace App\Repositories;

use App\Models\Activity;
use Illuminate\Support\Collection;

class ActivityRepository
{
    public function __construct(private Activity $model)
    {
    }

    public function all(array $relations = []): Collection
    {
        return $this->model
            ->with($relations)
            ->get();
    }

    public function store(array $parameters): Activity
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save();

        return $model;
    }

    public function update(Activity $activity, array $parameters): Activity
    {
        $activity
            ->fill($parameters)
            ->save();

        return $activity;
    }

    /**
     * @throws \Exception
     */
    public function delete(Activity $activity): bool
    {
        return (bool) $activity->delete();
    }
}
