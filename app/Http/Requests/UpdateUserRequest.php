<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var null|User $user */
        $user = $this->input('user');

        /** @var User $auth */
        $auth = Auth::user();

        $rules = [
            'name' => 'required|string|max:100',
            'password' => 'nullable|string|confirmed|min:6',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($user?->getKey(), $user?->getKeyName()),
            ],
        ];

        if ($auth->hasRole('admin')) {
            $rules['role'] = [
                'required',
                'string',
                Rule::in(User::ROLES),
            ];
        }

        return $rules;
    }
}
