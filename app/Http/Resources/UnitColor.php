<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitColor extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'code'    => $this->code,
            'type'    => $this->type
        ];
    }
}
