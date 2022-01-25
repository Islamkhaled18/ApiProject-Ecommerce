<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Http\Resources\AdvertiseResource;
use Illuminate\Support\Facades\Validator;
use App\Traits\AdvertiseApiResponseTrait;


class AdvertiseController extends Controller
{
    use AdvertiseApiResponseTrait;

    public function index(){

        $advertises = AdvertiseResource::collection(Advertise::get());
        return $this->advertiseApiResponse($advertises,'ok',200);

    }

    public function show($id){

        $advertise = Advertise::find($id);

        if($advertise){
            return $this->advertiseApiResponse(new AdvertiseResource($advertise),'ok',200);
        }
        return $this->advertiseApiResponse(null,'The post Not Found',404);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'advertise_street' => 'required',
            'advertise_city' => 'required',
            'advertise_category' => 'required',
            'advertise_model' => 'required',
            'advertise_phone' => 'required',
            'advertise_price' => 'required',
            'advertise_photo' => 'required',
            'advertise_description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->advertiseApiResponse(null,$validator->errors(),400);
        }

        if ($request->hasFile('advertise_photo')) {
            $imageName = $request->advertise_photo->getClientOriginalName();
            $imageExt  = $request->advertise_photo->getClientOriginalExtension();
            $newName = uniqid("", true) . '.' . $imageExt;
            $path = $request->advertise_photo->move('images/advertises', $imageName);
            $advertise_photo_value = $path;
        } else {
            $advertise_photo_value = ' ';
        }         


        $advertise = new Advertise();
        $advertise->advertise_street        = $request->advertise_street;
        $advertise->advertise_city          = $request->advertise_city;
        $advertise->advertise_category      = $request->advertise_category;
        $advertise->advertise_model         = $request->advertise_model;
        $advertise->advertise_phone         = $request->advertise_phone;
        $advertise->advertise_price         = $request->advertise_price;
        $advertise->advertise_photo         = $advertise_photo_value;
        $advertise->advertise_description   = $request->advertise_description;
        $advertise->save();

        if($advertise){
            return $this->advertiseApiResponse(new AdvertiseResource($advertise),'The advertise Saved',201);
        }

        return $this->advertiseApiResponse(null,'The advertise Not Save',400);
    }


    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'advertise_street' => 'required',
            'advertise_city' => 'required',
            'advertise_category' => 'required',
            'advertise_model' => 'required',
            'advertise_phone' => 'required',
            'advertise_price' => 'required',
            'advertise_photo' => 'required',
            'advertise_description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->advertiseApiResponse(null,$validator->errors(),400);
        }

        $advertise = Advertise::find($id);

        if(!$advertise){
            return $this->advertiseApiResponse(null,'The advertise Not Found',404);
        }

        if ($request->hasFile('advertise_photo')) {
            $imageName = $request->advertise_photo->getClientOriginalName();
            $imageExt  = $request->advertise_photo->getClientOriginalExtension();
            $newName = uniqid("", true) . '.' . $imageExt;
            $path = $request->advertise_photo->move('images/advertises', $imageName);
            $advertise_photo_value = $path;
        } else {
            $advertise_photo_value = ' ';
        }   

        $advertise->update([
            'advertise_street' => $request->advertise_street,
            'advertise_city' => $request->advertise_city,
            'advertise_category' => $request->advertise_category,
            'advertise_model' => $request->advertise_model,
            'advertise_phone' => $request->advertise_phone,
            'advertise_price' => $request->advertise_price,
            'advertise_photo' => $advertise_photo_value,
            'advertise_description' => $request->advertise_description,
        ]);

        if($advertise){
            return $this->advertiseApiResponse(new AdvertiseResource($advertise),'The post update',201);
        }

    }


    public function destroy($id){

        $advertise = Advertise::find($id);
        if(!$advertise){
            return $this->advertiseApiResponse(null,'The advertise Not Found',404);
        }

        $advertise->delete($id);

        if($advertise){
            return $this->advertiseApiResponse(null,'The service deleted',200);
        }


  
    }

   

}
