<?php

namespace App\Http\Resources\Integration\Sunnies;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SunmobileApplyProgramCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "count" => 0,
            "data"  => SunmobileApplyProgramResource::collection($this->collection),
            "end"   => 0,
            "page"  => "1",
            "pages" => 1,
            "query" => "",
            "start" => 1,
        ];
    }
}
