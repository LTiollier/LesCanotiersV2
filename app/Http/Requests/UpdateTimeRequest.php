<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'minutes' => 'required|integer',
            'date' => 'required|date',
            'quantity' => 'nullable|integer',
        ];
    }
}
