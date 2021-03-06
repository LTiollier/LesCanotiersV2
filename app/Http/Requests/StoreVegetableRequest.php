<?php

namespace App\Http\Requests;

use App\Models\Vegetable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Webmozart\Assert\Assert;

class StoreVegetableRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'vegetable_category_id' => 'required|exists:vegetable_categories,id',
        ];

        if ($this->getMethod() == 'PUT') {
            Assert::isInstanceOf($this->vegetable, Vegetable::class);

            $rules = array_merge($rules, [
                'name' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('vegetables', 'name')
                        ->ignore($this->vegetable->getKey(), $this->vegetable->getKeyName()),
                ],
            ]);
        }
        if ($this->getMethod() == 'POST') {
            $rules = array_merge($rules, [
                'name' => 'required|unique:vegetables,name|string|max:100',
            ]);
        }

        return $rules;
    }
}
