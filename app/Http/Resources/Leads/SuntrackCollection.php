<?php

namespace App\Http\Resources\Leads;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SuntrackCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => SuntrackResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
