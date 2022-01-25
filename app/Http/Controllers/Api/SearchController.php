<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertise;

class SearchController extends Controller
{
    public function index(Request $request){
        $searchResult = Advertise::where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('advertise_model', 'like', '%' . $request->search . '%');

            });

        })->latest()->first();

        if($searchResult){
            return Response()->json($searchResult);
           }
           else
           {
           return response()->json(['Result' => 'No Data not found'], 404);
         }

    }
}
