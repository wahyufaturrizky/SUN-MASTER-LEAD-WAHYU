<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->branch_id,
            // 'branch_code' => $this->branch_code,
            'name' => $this->branch_name,
            // 'branch_area' => $this->branch_area,
        ];
    }
}
