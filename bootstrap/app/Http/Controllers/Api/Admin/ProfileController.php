<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Auth;

class ProfileController extends Controller
{
    //
    public function admin_update_profile(Request $req,$id)
    {
        $controlls=$req->all();
        $rules=array(
            "name"=>"required",
            "email"=>"nullable|email",
            "image"=>"nullable|image"
        );

        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            return response(['status' => false, 'errors' => $validator->errors()]);
        }
        else{
            $profile = Admin::find($id);
            $profile->name = $req->name;
            $profile->email = $req->email;
             if ($req->hasFile('image')) {
                $file=$req->file('image');
                $filename=$file->getClientOriginalName();
                $path=public_path("/uploads/profile/");
                $file->move($path,$filename);
                $profile->image = asset("/uploads/profile/".$filename);
            }
            $profile->save();
            $token = Admin::where('id',$id)->first()->createToken('LaravelAuthApp')->accessToken;

            return response(['status' => true, 'message' => "Profile Successfully Updated", 'user' => $profile, 'token' => $token]);
        }
    }
}
