<?php

namespace App\Http\Resources;

use App\Models\Activity;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /** @var Activity */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'name' => $this->resource->name,
        ];
    }
}
