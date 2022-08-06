<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Validator;

class SaidController extends Controller
{
    //
    public function said_process(Request $req)
    {
        $controlls=$req->all();
        $rules=array(
            "person_A"=>"required",
            "person_B"=>"required",
            "statement"=>"required",
            "link_statement"=>"required",
            "date"=>"required",
            "status"=>"required"
        );

        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            // dd($validator);
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        else
        {
            $person = new Person;
            $person->person_A = $req->person_A;
            $person->person_B = $req->person_B;
            $person->statement = $req->statement;
            $person->link_statement = $req->link_statement;
            $person->date = $req->date;
            $person->status = $req->status;
            $person->public_status = 'disable';
            $person->save();
            
            return response()->json(['status' => true, 'message' => "Statement Successfully Created"]);
        }
    }
}
