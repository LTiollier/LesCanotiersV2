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
            'time' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'cycle' => 'array',
            'cycle.id' => 'required|exists:cycles,id',
            'activity' => 'array',
            'activity.id' => 'required|exists:activities,id',
            'user' => 'array',
            'user.id' => 'required|exists:users,id',
        ];
    }
}
