<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Webmozart\Assert\Assert;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', User::class);

        return Inertia::render('User/UserIndex', [
            'users' => $this->userRepository->all()
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', User::class);

        return Inertia::render('User/UserCreate', [
            'roles' => User::ROLES
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->authorize('store', User::class);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->userRepository->store($parameters);

        return redirect()->route('users.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(User $user): Response
    {
        $this->authorize('edit', [$user, $user]);

        return Inertia::render('User/UserEdit', [
            'user' => UserResource::make($user),
            'roles' => User::ROLES
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', [$user, $user]);

        $parameters = $request->validated();
        Assert::isArray($parameters);

        $this->userRepository->update($user, $parameters);

        return redirect()->route('users.edit', $user);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', [$user, $user]);

        /** @var User $auth */
        $auth = auth()->user();
        if ($auth->getKey() === $user->getKey()) {
            Auth::logout();
        }

        $this->userRepository->delete($user);

        return redirect()->route('users.index');
    }
}
