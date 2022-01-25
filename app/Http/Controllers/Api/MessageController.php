<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Validator;
use App\Traits\MessageApiResponseTrait;


class MessageController extends Controller
{
    use MessageApiResponseTrait;

    public function send(Request $request)
    {
       
        $data = $request->validate([

            'message' => 'required|string|max:1000',
        ]);


        $message = Message::create($request->all());


        return response($message,200);

    }

    public function messages(Request $request)
    {

        $messages = MessageResource::collection(Message::get());
        return $this->messageApiResponse($messages,'ok',200);

    }
}
