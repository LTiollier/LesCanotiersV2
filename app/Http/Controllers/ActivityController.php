<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Repositories\ActivityRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class ActivityController extends Controller
{
    public function __construct(private ActivityRepository $activityRepository)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Activity::class);

        return Inertia::render('Activity/ActivityIndex', [
            'activities' => $this->activityRepository->all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', Activity::class);

        return Inertia::render('Activity/ActivityCreate');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->authorize('store', Activity::class);

        $this->activityRepository->store($parameters);

        return redirect()->route('activities.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Activity $activity): Response
    {
        $this->authorize('edit', $activity);

        return Inertia::render('Activity/ActivityEdit', [
            'activity' => ActivityResource::make($activity),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Activity $activity, StoreActivityRequest $request): RedirectResponse
    {
        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->authorize('update', $activity);

        $this->activityRepository->update($activity, $parameters);

        return redirect()->route('activities.index');
    }

    /**
     * @throws \Exception
     */
    public function destroy(Activity $activity): RedirectResponse
    {
        $this->authorize('delete', $activity);

        $this->activityRepository->delete($activity);

        return redirect()->route('activities.index');
    }
}
