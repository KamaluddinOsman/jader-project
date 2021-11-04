<?php

namespace App\Http\Resources;

use App\District;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\District as DistrictResource;
use Illuminate\Http\Resources\Json\Resource;

class Store extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'category_id' => $this->category_id,
            'city_id' => $this->city_id,
            'logo' => $this->logo,
            'name' => $this->name,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'company_register' => $this->company_register,
            'num_tax' => $this->num_tax,
            'address' => $this->address,
            'lang' => $this->lang,
            'late' => $this->late,
            'about' => $this->about,
            'minimum_order' => $this->minimum_order,
            'delivery_price' => $this->delivery_price,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'site' => $this->site,
            'status' => $this->status,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'city' => new DistrictResource($this->district),
            'client' => $this->client,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'day_work' => json_decode($this->day_work),
            'name_responsible' => $this->name_responsible,
            'responsible_position' => $this->responsible_position,
            'responsible_mobile' => $this->responsible_mobile,
            'name_authorized' => $this->name_authorized,
            'authorized_mobile' => $this->authorized_mobile,
            'legal_name' => $this->legal_name,
            'ipan' => $this->ipan,
            'name_card' => $this->name_card,
            'bank_name' => $this->bank_name,
            'order_processing_time' => $this->order_processing_time,
            'ratio' => $this->ratio,
        ];
    }
}
