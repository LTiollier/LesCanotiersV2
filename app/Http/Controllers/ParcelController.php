<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParcelRequest;
use App\Http\Resources\ParcelResource;
use App\Models\Parcel;
use App\Repositories\ParcelRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class ParcelController extends Controller
{
    public function __construct(private ParcelRepository $parcelRepository)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Parcel::class);

        return Inertia::render('Parcel/ParcelIndex', [
            'parcels' => $this->parcelRepository->all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', Parcel::class);

        return Inertia::render('Parcel/ParcelCreate');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreParcelRequest $request): RedirectResponse
    {
        $this->authorize('store', Parcel::class);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->parcelRepository->store($parameters);

        return redirect()->route('parcels.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Parcel $parcel): Response
    {
        $this->authorize('edit', $parcel);

        return Inertia::render('Parcel/ParcelEdit', [
            'parcel' => ParcelResource::make($parcel),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Parcel $parcel, StoreParcelRequest $request): RedirectResponse
    {
        $this->authorize('update', $parcel);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->parcelRepository->update($parcel, $parameters);

        return redirect()->route('parcels.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Parcel $parcel): RedirectResponse
    {
        $this->authorize('delete', $parcel);

        $this->parcelRepository->delete($parcel);

        return redirect()->route('parcels.index');
    }
}
