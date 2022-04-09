<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\CycleResource;
use App\Http\Resources\TimeResource;
use App\Models\Time;
use App\Repositories\ActivityRepository;
use App\Repositories\CycleRepository;
use App\Repositories\TimeRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class TimeController extends Controller
{
    public function __construct(
        private TimeRepository $timeRepository,
        private CycleRepository $cycleRepository,
        private ActivityRepository $activityRepository
    ) {
    }

    public function index(): Response
    {
        return Inertia::render('Time/TimeIndex', [
            'times' => $this->timeRepository->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Time/TimeCreate', [
            'cycles' => CycleResource::collection($this->cycleRepository->getFromNow()),
            'activities' => ActivityResource::collection($this->activityRepository->all()),
        ]);
    }

    public function store(StoreTimeRequest $request): RedirectResponse
    {
        $parameters = $request->validated();
        Assert::isArray($parameters);

        if (Arr::get($parameters, 'cycle.id', null)) {
            $parameters['cycle_id'] = Arr::get($parameters, 'cycle.id', null);
        }

        if (Arr::get($parameters, 'activity.id', null)) {
            $parameters['activity_id'] = Arr::get($parameters, 'activity.id', null);
        }

        if (Arr::get($parameters, 'user.id', null)) {
            $parameters['user_id'] = Arr::get($parameters, 'user.id', null);
        }

        $this->timeRepository->store($parameters);

        return redirect()->route('times.index');
    }

    public function edit(Time $time): Response
    {
        $time->load([
            'activity',
            'user',
            'cycle.vegetable',
            'cycle.parcel',
        ]);

        return Inertia::render('Time/TimeEdit', [
            'time' => TimeResource::make($time),
            'cycles' => CycleResource::collection($this->cycleRepository->getFromNow()),
            'activities' => ActivityResource::collection($this->activityRepository->all()),
        ]);
    }

    public function update(Time $time, UpdateTimeRequest $request): RedirectResponse
    {
        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->timeRepository->update($time, $parameters);

        return redirect()->route('times.index');
    }

    /**
     * @throws \Exception
     */
    public function destroy(Time $time): RedirectResponse
    {
        $this->timeRepository->delete($time);

        return redirect()->route('times.index');
    }
}
