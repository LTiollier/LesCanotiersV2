<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:activities,name|string|max:100',
        ];
    }
}
