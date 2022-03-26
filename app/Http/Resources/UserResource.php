<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /** @var User */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'email' => $this->resource->email,
            'name' => $this->resource->name,
        ];
    }
}
