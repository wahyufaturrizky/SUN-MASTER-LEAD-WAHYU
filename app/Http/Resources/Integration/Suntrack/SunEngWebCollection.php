<?php

namespace App\Http\Resources\Integration\Suntrack;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SunEngWebCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return SunEngWebResource::collection($this->collection);
    }
}
