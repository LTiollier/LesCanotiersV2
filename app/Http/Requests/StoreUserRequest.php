<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'role' => [
                'required',
                'string',
                Rule::in(User::ROLES),
            ],
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|email|unique:users,email',
        ];
    }
}
