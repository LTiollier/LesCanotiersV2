<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVegetableRequest;
use App\Http\Resources\VegetableCategoryResource;
use App\Http\Resources\VegetableResource;
use App\Models\Vegetable;
use App\Repositories\VegetableCategoryRepository;
use App\Repositories\VegetableRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class VegetableController extends Controller
{
    public function __construct(
        private VegetableCategoryRepository $vegetableCategoryRepository,
        private VegetableRepository $vegetableRepository
    ) {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Vegetable::class);

        return Inertia::render('Vegetable/VegetableIndex', [
            'vegetables' => $this->vegetableRepository->all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', Vegetable::class);

        return Inertia::render('Vegetable/VegetableCreate', [
            'vegetableCategories' => VegetableCategoryResource::collection($this->vegetableCategoryRepository->all())
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreVegetableRequest $request): RedirectResponse
    {
        $this->authorize('store', Vegetable::class);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->vegetableRepository->store($parameters);

        return redirect()->route('vegetables.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Vegetable $vegetable): Response
    {
        $this->authorize('edit', $vegetable);

        $vegetable->load(['vegetableCategory']);

        return Inertia::render('Vegetable/VegetableEdit', [
            'vegetable' => VegetableResource::make($vegetable),
            'vegetableCategories' => VegetableCategoryResource::collection($this->vegetableCategoryRepository->all())
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Vegetable $vegetable, StoreVegetableRequest $request): RedirectResponse
    {
        $this->authorize('update', $vegetable);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->vegetableRepository->update($vegetable, $parameters);

        return redirect()->route('vegetables.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Vegetable $vegetable): RedirectResponse
    {
        $this->authorize('delete', $vegetable);

        $this->vegetableRepository->delete($vegetable);

        return redirect()->route('vegetables.index');
    }
}
