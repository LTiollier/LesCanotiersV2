<?php

namespace App\Repositories;

use App\Models\Cycle;
use Illuminate\Support\Collection;

class CycleRepository
{
    public function __construct(private Cycle $model)
    {
    }

    public function all(array $relations = []): Collection
    {
        return $this->model
            ->with($relations)
            ->get()
        ;
    }

    public function getFromNow(): Collection
    {
        $now = now();

        return $this->model
            ->where(function ($query) use ($now) {
                $query->whereDate('starts_at', '<=', $now)
                    ->whereDate('ends_at', '>=', $now)
                ;
            })->orWhere(function ($query) use ($now) {
                $query->whereDate('starts_at', '<=', $now)
                    ->whereNull('ends_at')
                ;
            })
            ->with(['vegetable', 'parcel'])
            ->get()
        ;
    }

    public function store(array $parameters): Cycle
    {
        $model = $this->model->newInstance();
        $model->fill($parameters)
            ->save()
        ;

        return $model;
    }

    public function update(Cycle $cycle, array $parameters): Cycle
    {
        $cycle
            ->fill($parameters)
            ->save()
        ;

        return $cycle;
    }

    /**
     * @throws \Exception
     */
    public function delete(Cycle $cycle): bool
    {
        return (bool) $cycle->delete();
    }
}
