<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Http\Resources\AboutUsResource;
use Illuminate\Support\Facades\Validator;
use App\Traits\AboutUsApiResponseTrait;


class AboutUsController extends Controller
{
    use AboutUsApiResponseTrait;

    public function index(){

        $aboutUs = AboutUsResource::collection(AboutUs::get());
        return $this->aboutUsApiResponse($aboutUs,'ok',200);

    }

    public function show($id){

        $aboutUs = AboutUs::find($id);

        if($aboutUs){
            return $this->aboutUsApiResponse(new AboutUsResource($aboutUs),'ok',200);
        }
        return $this->aboutUsApiResponse(null,'The AboutUs Not Found',404);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'aboutUs_details' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $this->aboutUsApiResponse(null,$validator->errors(),400);
        }
        $aboutUs = new AboutUs();
        $aboutUs->aboutUs_details = $request->aboutUs_details;
        $aboutUs->save();

        if($aboutUs){
            return $this->aboutUsApiResponse(new AboutUsResource($aboutUs),'The AboutUs Saved',201);
        }

        return $this->aboutUsApiResponse(null,'The AboutUs Not Save',400);
    }



    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'aboutUs_details' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->aboutUsApiResponse(null,$validator->errors(),400);
        }

        $aboutUs = AboutUs::find($id);
        if(!$aboutUs){
            return $this->aboutUsApiResponse(null,'The aboutUs Not Found',404);
        }

       
        $aboutUs->update([
            'aboutUs_details' => $request->aboutUs_details,
        ]);

        if($aboutUs){
            return $this->aboutUsApiResponse(new AboutUsResource($aboutUs),'The aboutUs update',201);
        }

    }

    public function destroy($id){

        $aboutUs = AboutUs::find($id);

        if(!$aboutUs){
            return $this->aboutUsApiResponse(null,'The aboutUs Not Found',404);
        }

        $aboutUs->delete($id);

        if($aboutUs){
            return $this->aboutUsApiResponse(null,'The aboutUs deleted',200);
        }
    }
}
