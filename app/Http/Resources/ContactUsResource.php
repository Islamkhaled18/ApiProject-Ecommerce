<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
            'sender_name'=>$this->sender_name,
            'sender_email'=>$this->sender_email,
            'sender_phone'=>$this->sender_phone,
            'sender_message'=>$this->sender_message,
            
        ];
    }
}
