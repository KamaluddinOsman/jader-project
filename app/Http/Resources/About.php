<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class About extends JsonResource
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
            'name' => $this->name,
            'about' => $this->about,
            'commission' => $this->commission,
            'phone' => $this->phone,
            'site' => $this->site,
            'facebook' => $this->facebook,
            'logo'  => $global.$this->logo,
        ];
    }
}
