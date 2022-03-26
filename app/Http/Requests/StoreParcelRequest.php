<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParcelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:parcels,name|string|max:100',
        ];
    }
}
