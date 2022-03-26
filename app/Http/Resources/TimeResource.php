<?php

namespace App\Http\Resources;

use App\Models\Time;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeResource extends JsonResource
{
    /** @var Time */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'date' => $this->resource->date,
            'minutes' => $this->resource->minutes,
            'quantity' => $this->resource->quantity,
            'cycle' => $this->whenLoaded('cycle', CycleResource::make($this->resource->cycle)),
            'activity' => $this->whenLoaded('activity', ActivityResource::make($this->resource->activity)),
            'user' => $this->whenLoaded('user', UserResource::make($this->resource->user)),
        ];
    }
}
