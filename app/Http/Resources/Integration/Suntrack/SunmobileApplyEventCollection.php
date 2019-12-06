<?php

namespace App\Http\Resources\Integration\Suntrack;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SunmobileApplyEventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
