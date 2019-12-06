<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WilayahResource extends JsonResource
{
    public function __construct($resource)
    {
        static::$wrap = null;
        $this->resource = $resource;
    }
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->zip_code,
            // 'name' => $this->zip_code . ' - ' . $this->kelurahan . ', ' . $this->kecamatan . ', ' . $this->dt2 . ' ' . $this->kabupaten . ', ' . $this->provinsi,
            'name' => $this->zip_code . ' | ' . $this->kelurahan . ', ' . $this->kecamatan,
        ];
    }
}
