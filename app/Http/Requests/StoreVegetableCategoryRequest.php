<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVegetableCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:vegetable_categories,name|string|max:100',
        ];
    }
}
