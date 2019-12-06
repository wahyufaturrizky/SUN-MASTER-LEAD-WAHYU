<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailVerificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'email_verification_id' => $this->email_verification_id,
            'email' => $this->email,
            'status' => $this->status,
            'sub_status' => $this->sub_status,
        ];
    }
}
