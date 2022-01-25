<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PreventProduct;
use App\Http\Resources\PreventProductResource;
use Illuminate\Support\Facades\Validator;
use App\Traits\PreventProductsApiResponseTrait;


class PreventProductController extends Controller
{
    use PreventProductsApiResponseTrait;

    public function index(){

        $preventproduct = PreventProductResource::collection(PreventProduct::get());
        return $this->preventProductsApiResponse($preventproduct,'ok',200);

    }

    public function show($id){

        $preventproduct = PreventProduct::find($id);

        if($preventproduct){
            return $this->preventProductsApiResponse(new PreventProductResource($preventproduct),'ok',200);
        }
        return $this->preventProductsApiResponse(null,'The preventproduct Not Found',404);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'preventProducts_details' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $this->preventProductsApiResponse(null,$validator->errors(),400);
        }
        $preventproduct = new PreventProduct();
        $preventproduct->preventProducts_details = $request->preventProducts_details;
        $preventproduct->save();

        if($preventproduct){
            return $this->preventProductsApiResponse(new PreventProductResource($preventproduct),'The preventproduct Saved',201);
        }

        return $this->preventProductsApiResponse(null,'The preventproduct Not Save',400);
    }



    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'preventProducts_details' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->preventProductsApiResponse(null,$validator->errors(),400);
        }

        $preventproduct = PreventProduct::find($id);
        if(!$preventproduct){
            return $this->preventProductsApiResponse(null,'The preventproduct Not Found',404);
        }

       
        $preventproduct->update([
            'preventProducts_details' => $request->preventProducts_details,
        ]);

        if($preventproduct){
            return $this->preventProductsApiResponse(new PreventProductResource($preventproduct),'The preventproduct update',201);
        }

    }

    public function destroy($id){

        $preventproduct = PreventProduct::find($id);

        if(!$preventproduct){
            return $this->preventProductsApiResponse(null,'The preventproduct Not Found',404);
        }

        $preventproduct->delete($id);

        if($preventproduct){
            return $this->preventProductsApiResponse(null,'The preventproduct deleted',200);
        }
    }
}
