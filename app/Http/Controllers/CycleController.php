<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCycleRequest;
use App\Http\Resources\CycleResource;
use App\Http\Resources\ParcelResource;
use App\Http\Resources\VegetableResource;
use App\Models\Cycle;
use App\Repositories\CycleRepository;
use App\Repositories\ParcelRepository;
use App\Repositories\VegetableRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class CycleController extends Controller
{
    public function __construct(
        private CycleRepository $cycleRepository,
        private VegetableRepository $vegetableRepository,
        private ParcelRepository $parcelRepository
    ) {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Cycle::class);

        return Inertia::render('Cycle/CycleIndex', [
            'cycles' => $this->cycleRepository->all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', Cycle::class);

        return Inertia::render('Cycle/CycleCreate', [
            'vegetables' => VegetableResource::collection($this->vegetableRepository->all()),
            'parcels' => ParcelResource::collection($this->parcelRepository->all()),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreCycleRequest $request): RedirectResponse
    {
        $this->authorize('store', Cycle::class);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->cycleRepository->store($parameters);

        return redirect()->route('cycles.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Cycle $cycle): Response
    {
        $this->authorize('edit', $cycle);

        $cycle->load([
            'vegetable',
            'parcel',
            'times.activity',
        ]);

        return Inertia::render('Cycle/CycleEdit', [
            'cycle' => CycleResource::make($cycle),
            'vegetables' => VegetableResource::collection($this->vegetableRepository->all()),
            'parcels' => ParcelResource::collection($this->parcelRepository->all()),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Cycle $cycle, StoreCycleRequest $request): RedirectResponse
    {
        $this->authorize('update', $cycle);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->cycleRepository->update($cycle, $parameters);

        return redirect()->route('cycles.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Cycle $cycle): RedirectResponse
    {
        $this->authorize('delete', $cycle);

        $this->cycleRepository->delete($cycle);

        return redirect()->route('cycles.index');
    }
}
