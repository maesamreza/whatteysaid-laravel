<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Auth;

class LoginController extends Controller
{
    //
    public function admin_login_process(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required|email|exists:admins',
            'password'=>'required|max:8'
        ],
        ['email.exists'=>'Admin Email Not Exists']);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'errors' => $validate->errors()]);
        }
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            $token = auth::guard('admin')->user()->createToken('LaravelAuthApp')->accessToken;
            $user = Auth::guard('admin')->user();
            return response()->json(['status' => true, 'message' => 'Admin Successfully Login', 'token' => $token, 'user' => $user]);
        }
        else{
            return response()->json(['status' => false, 'message' => 'Unauthorised']);
        }
    }
}
