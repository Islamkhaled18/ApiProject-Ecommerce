<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertiseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            
            'id'=>$this->id,
            'advertise_street'=>$this->advertise_street,
            'advertise_city'=>$this->advertise_city,
            'advertise_category'=>$this->advertise_category,
            'advertise_model'=>$this->advertise_model,
            'advertise_phone'=>$this->advertise_phone,
            'advertise_price'=>$this->advertise_price,
            'advertise_photo'=>$this->advertise_photo,
            'advertise_description'=>$this->advertise_description,
        ];
    }
}
