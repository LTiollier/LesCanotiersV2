<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'navigations' => [
                [
                    'label' => 'Ajouter un temps',
                    'url' => route('times.create'),
                ],
                [
                    'label' => 'Temps',
                    'url' => route('times.index'),
                ],
                [
                    'label' => 'Activités',
                    'url' => route('activities.index'),
                ],
                [
                    'label' => 'Cycles',
                    'url' => route('cycles.index'),
                ],
                [
                    'label' => 'Parcelles',
                    'url' => route('parcels.index'),
                ],
                [
                    'label' => 'Fruit/Légumes',
                    'url' => route('vegetables.index'),
                ],
                [
                    'label' => 'Catégories',
                    'url' => route('vegetableCategories.index'),
                ],
                [
                    'label' => 'Utilisateurs',
                    'url' => route('users.index'),
                ],
            ],
        ]);
    }
}
