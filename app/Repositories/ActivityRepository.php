<?php

namespace App\Repositories;

use App\Models\Activity;

class ActivityRepository
{
    public function __construct(private Activity $model)
    {
    }

    /**
     * @param array<string> $relations
     */
    public function all(array $relations = []): \Illuminate\Support\Collection
    {
        return $this->model
            ->with($relations)
            ->get()
        ;
    }

    /**
     * @param array<mixed> $parameters
     */
    public function store(array $parameters): Activity
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save()
        ;

        return $model;
    }

    /**
     * @param array<mixed> $parameters
     */
    public function update(Activity $activity, array $parameters): Activity
    {
        $activity
            ->fill($parameters)
            ->save()
        ;

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
