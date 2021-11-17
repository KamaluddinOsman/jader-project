<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Store as StoreResource;
use App\Http\Resources\Variety as VarietyResource;

class Product extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $global = config('constants.Url');
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'varieties_id' => $this->varieties_id,
            'brands_id' => $this->brands_id,
            'name'      => $this->name,
            'rate'      => $this->rate,
            'price'     => $this->price,
            'code'      => $this->code,
            'quantity'  => $this->quantity,
            'calories'  => $this->calories,
            'image1'    => $global.$this->image1,
            'image2'    => $global.$this->image2,
            'image3'    => $global.$this->image3,
            'image4'    => $global.$this->image4,
            'type'      => $this->type,
            'store'     => new StoreResource($this->store),
            'variety'   => new VarietyResource($this->variety),
            'color' => $this->colors,
            'size' => $this->sizes,

        ];
    }
}
