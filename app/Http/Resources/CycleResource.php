<?php

namespace App\Http\Resources;

use App\Models\Cycle;
use Illuminate\Http\Resources\Json\JsonResource;

class CycleResource extends JsonResource
{
    /** @var Cycle */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'starts_at' => $this->resource->starts_at,
            'ends_at' => $this->resource->ends_at,
            'vegetable' => $this->whenLoaded('vegetable', VegetableResource::make($this->resource->vegetable)),
            'parcel' => $this->whenLoaded('parcel', ParcelResource::make($this->resource->parcel)),
            'times' => $this->whenLoaded('times', TimeResource::collection($this->resource->times)),
        ];
    }
}
