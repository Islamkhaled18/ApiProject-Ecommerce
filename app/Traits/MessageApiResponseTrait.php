<?php

namespace App\Traits;

trait MessageApiResponseTrait
{

    public function messageApiResponse($data= null,$message = null,$status = null){

        $array = [
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
 
        return response($array,$status);
 
    }


}