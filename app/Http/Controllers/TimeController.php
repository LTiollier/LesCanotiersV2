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
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class TimeController extends Controller
{
    public function __construct(
        private readonly TimeRepository $timeRepository,
        private readonly CycleRepository $cycleRepository,
        private readonly ActivityRepository $activityRepository
    ) {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Time::class);

        return Inertia::render('Time/TimeIndex', [
            'times' => $this->timeRepository->all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', Time::class);

        return Inertia::render('Time/TimeCreate', [
            'cycles' => CycleResource::collection($this->cycleRepository->getFromNow()),
            'activities' => ActivityResource::collection($this->activityRepository->all()),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreTimeRequest $request): RedirectResponse
    {
        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->authorize('store', [Time::class, $parameters]);

        $this->timeRepository->store($parameters);

        return redirect()->route('times.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Time $time): Response
    {
        $this->authorize('edit', $time);

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

    /**
     * @throws AuthorizationException
     */
    public function update(Time $time, UpdateTimeRequest $request): RedirectResponse
    {
        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->authorize('update', [$time, $parameters]);

        $this->timeRepository->update($time, $parameters);

        return redirect()->route('times.index');
    }

    /**
     * @throws \Exception
     */
    public function destroy(Time $time): RedirectResponse
    {
        $this->authorize('delete', $time);

        $this->timeRepository->delete($time);

        return redirect()->route('times.index');
    }
}
