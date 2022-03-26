<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:100',
            'role' => [
                'required',
                'string',
                Rule::in(array_keys(User::ROLES))
            ]
        ];

        if ($this->getMethod() == 'PUT') {
            $rules = array_merge($rules, [
                'password' => 'nullable|string|confirmed|min:6',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')
                        ->ignore($this->user->getKey(), $this->user->getKeyName()),
                ]
            ]);
        }
        if ($this->getMethod() == 'POST') {
            $rules = array_merge($rules, [
                'password' => 'required|string|confirmed|min:6',
                'email' => 'required|email|unique:users,email',
            ]);
        }

        return $rules;
    }
}
