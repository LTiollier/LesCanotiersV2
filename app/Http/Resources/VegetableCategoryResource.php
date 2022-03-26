<?php

namespace App\Http\Resources;

use App\Models\VegetableCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class VegetableCategoryResource extends JsonResource
{
    /** @var VegetableCategory */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'name' => $this->resource->name,
            'vegetables' => $this->whenLoaded(
                'vegetables',
                VegetableResource::collection($this->resource->vegetables)
            ),
        ];
    }
}
