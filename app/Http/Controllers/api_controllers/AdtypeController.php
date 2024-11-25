<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Adtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdtypeController extends Controller
{
    //******************************  add_adtype *********************************
    public function add_adtype(Request $request)
    {
        try {
            $type = new Adtype();
            $type->type_en = $request->type_en;
            $type->type_ar = $request->type_ar;
            $type->save();
            return response()->json(['status' => 'success', 'data' => $type, 'message' => 'Adtype Added Successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'data' => $th->getMessage()], 404);
        }
    }

    // ********************* show_adtypes ***********************
    public function show_adtypes(){
        try {
            $types = Adtype::with('ads')->inRandomOrder()->get();
            return response()->json(['status'=> 'success','data'=> $types,'message'=> 'Adtypes Fetched Successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 'error', 'data'=> $th->getMessage()],404);
        }
    }

    // ********************* update_adtype ***********************
    public function update_adtype(Request $request, $id){
        try {
            $type =  Adtype::findOrFail($id);
            $type->type_en = $request->type_en;
            $type->type_ar = $request->type_ar;
            $type->save();
            return response()->json(['status' => 'success', 'data' => $type, 'message' => 'Adtype Added Successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'data' => $th->getMessage()], 404);
        }
    }


    // ********************* delete_adtype ***********************
    public function delete_adtype($id){
        try {
            $type = Adtype::findOrFail($id);
            $type->delete();
            return response()->json(['status' => 'success', 'message' => 'Adtype Deleted Successfully'], 200);
        } catch (\Throwable $th) {  
            return response()->json(['status' => 'error', 'data' => $th->getMessage()], 404);
        }
    }
}
