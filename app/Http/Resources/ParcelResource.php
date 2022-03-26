<?php

namespace App\Http\Resources;

use App\Models\Parcel;
use Illuminate\Http\Resources\Json\JsonResource;

class ParcelResource extends JsonResource
{
    /** @var Parcel */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'name' => $this->resource->name,
        ];
    }
}
