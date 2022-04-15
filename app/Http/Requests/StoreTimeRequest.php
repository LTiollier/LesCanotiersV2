<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'minutes' => 'required|integer',
            'date' => 'required|date',
            'quantity' => 'nullable|integer',
            'cycle_id' => 'required|exists:cycles,id',
            'activity_id' => 'required|exists:activities,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
