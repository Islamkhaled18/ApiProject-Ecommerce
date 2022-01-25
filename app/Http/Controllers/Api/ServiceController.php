<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Validator;
use App\Traits\ServiceApiResponseTrait;
use App\Models\User;
use App\Models\Comment;


class ServiceController extends Controller
{
    use ServiceApiResponseTrait;

    public function index(){

        $services = ServiceResource::collection(Service::get());
        return $this->serviceApiResponse($services,'ok',200);

    }

    public function show($id){

        $service = Service::find($id);

        if($service){
            return $this->serviceApiResponse(new ServiceResource($service),'ok',200);
        }
        return $this->serviceApiResponse(null,'The service Not Found',404);

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'service_name' => 'required|max:255',
            'service_photo' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->serviceApiResponse(null,$validator->errors(),400);
        }

        if ($request->hasFile('service_photo')) {
            $imageName = $request->service_photo->getClientOriginalName();
            $imageExt  = $request->service_photo->getClientOriginalExtension();
            $newName = uniqid("", true) . '.' . $imageExt;
            $path = $request->service_photo->move('images', $imageName);
            $service_photo_value = $path;
        } else {
            $service_photo_value = ' ';
        }         

        $service = new Service();
        $service->service_name         = $request->service_name;
        $service->service_photo         = $service_photo_value;
        $service->save();

        if($service){
            return $this->serviceApiResponse(new ServiceResource($service),'The service Saved',201);
        }

        return $this->serviceApiResponse(null,'The service Not Save',400);
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'service_name' => 'required|max:255',
            'service_photo' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->serviceApiResponse(null,$validator->errors(),400);
        }

        $service = Service::find($id);

        if(!$service){
            return $this->serviceApiResponse(null,'The service Not Found',404);
        }

        if ($request->hasFile('service_photo')) {
            $imageName = $request->service_photo->getClientOriginalName();
            $imageExt  = $request->service_photo->getClientOriginalExtension();
            $newName = uniqid("", true) . '.' . $imageExt;
            $path = $request->service_photo->move('images', $imageName);
            $service_photo_value = $path;
        } else {
            $service_photo_value = ' ';
        }   

        $service->update([
            'service_name' => $request->service_name,
            'service_photo' => $service_photo_value,
          
        ]);

        if($service){
            return $this->serviceApiResponse(new ServiceResource($service),'The service update',201);
        }

    }

    public function destroy($id){

        $service = Service::find($id);

        if(!$service){
            return $this->serviceApiResponse(null,'The service Not Found',404);
        }

        $service->delete($id);

        if($service){
            return $this->serviceApiResponse(null,'The service deleted',200);
        }

    }
    
    public function storeComment(Request $request)
    { 
        $comment = Comment::create([
            'user_name' => $request->user_name,
            'user_comment' => $request->user_comment,
            'service_id' => $request->service_id,
        ]);

        return response()->json($comment);
    }



}
