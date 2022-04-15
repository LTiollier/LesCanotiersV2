<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVegetableCategoryRequest;
use App\Http\Resources\VegetableCategoryResource;
use App\Models\VegetableCategory;
use App\Repositories\VegetableCategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class VegetableCategoryController extends Controller
{
    public function __construct(private readonly VegetableCategoryRepository $vegetableCategoryRepository)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', VegetableCategory::class);

        return Inertia::render('VegetableCategory/VegetableCategoryIndex', [
            'vegetableCategories' => $this->vegetableCategoryRepository->all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', VegetableCategory::class);

        return Inertia::render('VegetableCategory/VegetableCategoryCreate');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreVegetableCategoryRequest $request): RedirectResponse
    {
        $this->authorize('store', VegetableCategory::class);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->vegetableCategoryRepository->store($parameters);

        return redirect()->route('vegetableCategories.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(VegetableCategory $vegetableCategory): Response
    {
        $this->authorize('edit', $vegetableCategory);

        return Inertia::render('VegetableCategory/VegetableCategoryEdit', [
            'vegetableCategory' => VegetableCategoryResource::make($vegetableCategory),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(
        VegetableCategory $vegetableCategory,
        StoreVegetableCategoryRequest $request
    ): RedirectResponse {
        $this->authorize('update', $vegetableCategory);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->vegetableCategoryRepository->update($vegetableCategory, $parameters);

        return redirect()->route('vegetableCategories.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(VegetableCategory $vegetableCategory): RedirectResponse
    {
        $this->authorize('delete', $vegetableCategory);

        $this->vegetableCategoryRepository->delete($vegetableCategory);

        return redirect()->route('vegetableCategories.index');
    }
}
