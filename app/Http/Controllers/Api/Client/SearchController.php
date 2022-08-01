<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Validator;



class SearchController extends Controller
{
    //
    public function search(Request $request){
        $controlls=$request->all();
        $rules=array(
            "person_A"=>"required",
            "person_B"=>"required"
        );
        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        $results = Person::where('person_A', 'like',"{$request->person_A}%")
        ->where('person_B', 'like',"{$request->person_B}%")->get();
        return response()->json(['status' => true, 'results' => $results]);
    }
}
