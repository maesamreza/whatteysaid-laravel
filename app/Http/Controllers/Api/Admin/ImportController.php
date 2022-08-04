<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonImport;

class ImportController extends Controller
{
    //
    public function fileImport_procedure(Request $request)
    {
        try{
            Excel::import(new PersonImport,request()->file('file'));
            //return back();
            return response()->json(['status' => true, 'message' => "File Successfully Uploaded"]);

        } 
        catch (\Exception $e){
            //dd($e->getMessage());
            //return back();
            return response()->json(['status' => 'false', 'message' => "Uploading Failed"]);
        }
    }
}
