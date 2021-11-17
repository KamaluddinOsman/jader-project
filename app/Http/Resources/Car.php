<?php

namespace App\Http\Resources;

use App\Http\Resources\District as DistrictResource;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Car extends Resource
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
            'id'              => $this->id,
            'number'          => $this->number,
            'client_id'       => $this->client_id,
            'Type_car'        => $this->Type_car,
            'driver_license'  => $this->driver_license,
            'car_license'     => $this->car_license,
            'personal_id'     => $this->personal_id,
            'image_car_front' => $this->image_car_front,
            'image_car_back'  => $this->image_car_back,
            'car_model'       => $this->car_model,
            'car_category'    => $this->car_category,
            'stc_pay'         => $this->stc_pay,
            'char_car'        => $this->char_car,
            'status'          => $this->status,
            'nationality'     => $this->nationality_id,
            'date_of_birth'   => $this->date_of_birth,
            'gender'          => $this->gender,
            'activated'       => $this->activated,
            'bank_name'       => $this->bank_name,
            'name_card'       => $this->name_card,
            'ipan'            => $this->ipan,
            'nationality_id'  => $this->nationality_id,
            'brand_id'        => new Brand($this->brand),
        ];
    }
}
