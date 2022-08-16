<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Validator;

class PersonController extends Controller
{
    //
    public function counts(){
        $count = Person::where('public_status','enable')->count();
        return response()->json(['status' => true, 'count' => $count]);
    }
    
    public function person_view(){
        $persons = Person::where('public_status','enable')->get();
        return response()->json(['status' => true, 'persons' => $persons]);
    }

    public function said_view(){
        $persons = Person::where('public_status','disable')->get();
        return response()->json(['status' => true, 'persons' => $persons]);
    }
    
    public function person_edit($id){
        $edit = Person::find($id);
        if($edit){
            return response()->json(['status' => true, 'edit' => $edit]);
        }
        else{
            return response()->json(['status' => false, 'message' => "ID Not Found"]);
        }
    }

    public function delete_person($id){
        $delete_person = Person::find($id);
        if($delete_person){
            $delete_person->delete();
            return response()->json(['status' => true, 'message' => 'Person Successfully Deleted']);
        }
        else{
            return response()->json(['status' => false, 'message' => "ID Not Found"]);
        }
    }

    public function person_process(Request $req)
    {
        $controlls=$req->all();
        $rules=array(
            "person_A"=>"required",
            "person_B"=>"required",
            "statement"=>"required",
            "link_statement"=>"required",
            //"date"=>"required",
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
            $person->save();
            
            return response()->json(['status' => true, 'message' => "Person Successfully Created"]);
        }
    }

    public function person_update(Request $req,$id)
    {
        $controlls=$req->all();
        $rules=array(
            "person_A"=>"required",
            "person_B"=>"required",
            "statement"=>"required",
            "link_statement"=>"required",
            //"date"=>"required",
            "status"=>"required"
        );

        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            // dd($validator);
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        else
        {
            $person = Person::find($id);
            $person->person_A = $req->person_A;
            $person->person_B = $req->person_B;
            $person->statement = $req->statement;
            $person->link_statement = $req->link_statement;
            $person->date = $req->date;
            $person->status = $req->status;
            $person->save();

            return response()->json(['status' => true, 'message' => "Person Successfully Updated"]);
        }
    }
    
    public function status_update(Request $req,$id)
    {
        $controlls=$req->all();
        $rules=array(
            "public_status"=>"required",
        );

        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            // dd($validator);
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        else
        {
            $person = Person::find($id); 
            $person->public_status = $req->public_status;
            $person->save();

            return response()->json(['status' => true, 'message' => "Statement Status Successfully Updated"]);
        }
    }
    
    public function all_status_update(Request $req)
    {
        $controlls=$req->all();
        $rules=array(
            "id"=>"required",
        );

        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            // dd($validator);
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        else
        {
            $person = Person::whereIn('id',$req->id)->update(['public_status'=>$req->public_status]); 
            if($person){
            return response()->json(['status' => true, 'message' => "Statement Status Successfully Updated"]);}
        }
    }
}
