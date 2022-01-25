<?php

namespace App\Traits;

trait ServiceApiResponseTrait
{

    public function serviceApiResponse($data= null,$message = null,$status = null){

        $array = [
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
 
        return response($array,$status);
 
    }


}