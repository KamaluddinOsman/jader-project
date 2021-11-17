<?php

namespace App\Http\Resources;

use App\Http\Resources\District as DistrictResource;
use App\Http\Resources\Store as StoreResource;
use App\Http\Resources\Car as CarResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Client extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' =>$this->last_name,
            'full_name' =>$this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'image'  => $this->image,
            'api_token' => $this->api_token,
            'district_id' => $this->district_id,
            'district' => new DistrictResource($this->district),
            'store' => new StoreResource($this->stores),
            'car' => new CarResource($this->car),
        ];
    }
}
