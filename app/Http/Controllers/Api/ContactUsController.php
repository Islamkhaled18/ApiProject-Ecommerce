<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Http\Resources\ContactUsResource;
use Illuminate\Support\Facades\Validator;
use App\Traits\ContactUsApiResponseTrait;


class ContactUsController extends Controller
{
    use ContactUsApiResponseTrait;

    public function index(){

        $contactUs = ContactUsResource::collection(ContactUs::get());
        return $this->contactUsApiResponse($contactUs,'ok',200);

    }

    public function show($id){

        $contactUs = ContactUs::find($id);

        if($contactUs){
            return $this->contactUsApiResponse(new ContactUsResource($contactUs),'ok',200);
        }
        return $this->contactUsApiResponse(null,'The contactUs Not Found',404);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'sender_name' => 'required|max:255',
            'sender_email' => 'required|max:255|email',
            'sender_phone' => 'required|max:255',
            'sender_message' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $this->contactUsApiResponse(null,$validator->errors(),400);
        }
        $contactUs = new ContactUs();
        $contactUs->sender_name = $request->sender_name;
        $contactUs->sender_email = $request->sender_email;
        $contactUs->sender_phone = $request->sender_phone;
        $contactUs->sender_message = $request->sender_message;
        $contactUs->save();

        if($contactUs){
            return $this->contactUsApiResponse(new ContactUsResource($contactUs),'The contactUs Saved',201);
        }

        return $this->contactUsApiResponse(null,'The contactUs Not Save',400);
    }

    
    public function destroy($id){

        $contactUs = ContactUs::find($id);

        if(!$contactUs){
            return $this->contactUsApiResponse(null,'The contactUs Not Found',404);
        }

        $contactUs->delete($id);

        if($contactUs){
            return $this->contactUsApiResponse(null,'The contactUs deleted',200);
        }
    }

}
