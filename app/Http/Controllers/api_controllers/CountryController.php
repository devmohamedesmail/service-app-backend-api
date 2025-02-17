<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    // **************************** Add new country ********************************
    public function add_country(Request $request)
    {
        try {
            $country = new Country();
            $country->name_en = $request->name_en;
            $country->name_ar = $request->name_ar;
            $country->save();
            return response()->json(['data' => $country, 'message' => 'Country added successfully']);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage(), 'message' => $th->getMessage()]);
        }
    }

    // **************************** show_countries *********************************
    public function show_countries()
    {
        try {
            $countries = Country::with('ads')->inRandomOrder()->get();
            return response()->json(['data' => $countries, 'message' => 'Countries fetched successfully']);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage(), 'message' => $th->getMessage()]);
        }
    }

    // **************************** delete_country *********************************
    public function delete_country($id){
        try {
            $country = Country::findOrFail($id);
            $country->delete();
            return response()->json(['data' => $country, 'message' => 'Country deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['data'=> $th->getMessage(), 'message'=> $th->getMessage()]);
        }
    }

    // **************************** update_country *********************************
    public function update_country(Request $request, $id){
        try {
            $country = Country::findOrFail($id);
            $country->name_en = $request->name_en;
            $country->name_ar = $request->name_ar;
            return response()->json(['data' => $country, 'message' => 'Country updated successfully']);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage(), 'message' => $th->getMessage()]);
        }
    }
}
