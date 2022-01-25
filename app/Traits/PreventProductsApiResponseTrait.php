<?php

namespace App\Traits;

trait PreventProductsApiResponseTrait
{

    public function preventProductsApiResponse($data= null,$message = null,$status = null){

        $array = [
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
 
        return response($array,$status);
 
    }


}