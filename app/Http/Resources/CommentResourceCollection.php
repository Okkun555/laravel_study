<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentResourceCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->resource->map(function ($value) {
            return new CommentResource($value);
        })->all();
    }
}
