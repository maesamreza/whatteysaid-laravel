<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonImport;
use App\Models\ImportFile;
use Validator;

class ImportController extends Controller
{
    //
    public function fileImport_procedure(Request $request)
    {
        $controlls=$request->all();
        $rules=array(
            "file"=>"required"
        );
        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
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

    public function excel_download(){
        $file = ImportFile::first();
        return response()->json(['status' => true, 'file' => $file->file]);
    }
}
