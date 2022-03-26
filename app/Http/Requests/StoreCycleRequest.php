<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCycleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date',
            'vegetable' => 'array',
            'vegetable.id' => 'required|exists:vegetables,id',
            'parcel' => 'array',
            'parcel.id' => 'required|exists:parcels,id',
        ];
    }
}
