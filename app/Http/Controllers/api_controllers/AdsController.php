<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Country;

class AdsController extends Controller
{
    // **************** Add New Ads ****************
    public function add_ads(Request $request)
    {

        try {
            $ad = new Ad();
            $ad->user_id = $request->user_id;
            $ad->category_id = $request->category_id;
            $ad->country_id = $request->country_id;
            $ad->adtype_id = $request->type_id;
            $ad->title = $request->title;
            $ad->description = $request->description;
            $ad->link = $request->link;
            $ad->position = $request->position;
            $ad->phone = $request->phone;
            $ad->email = $request->email;
            $ad->website = $request->website;
            $ad->whatsup = $request->whatsup;
            $ad->price = $request->price;

            $imageNames = [];
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // Create a unique filename
                    $image->move(public_path('uploads/ads'), $imageName); // Move image to the specified directory
                    $imageNames[] = $imageName;
                }
                $ad->images = $imageNames;
               
            }

            $ad->save();
            return response()->json(['message' => 'Ad added successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    // **************** Get All Ads ****************
    public function show_ads(Request $request)
    {
        try {
            $ads = Ad::with('user.portfolio', 'category','country','type')->inRandomOrder()->get();
            return response()->json(['data' => $ads], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }



    // **************** Update Ad ****************
    public function update_ad(Request $request, $id)
    {
        try {
            $ad =  Ad::findOrFail($id);
            $ad->category_id = $request->category_id;
            $ad->country_id = $request->country_id;
            $ad->adtype_id = $request->type_id;
            $ad->title = $request->title;
            $ad->description = $request->description;
            $ad->link = $request->link;
            $ad->position = $request->position;
            $ad->phone = $request->phone;
            $ad->email = $request->email;
            $ad->website = $request->website;
            $ad->whatsup = $request->whatsup;
            $ad->city = $request->city;
            $ad->price = $request->price;
            $imageNames = [];
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // Create a unique filename
                    $image->move(public_path('uploads/ads'), $imageName); // Move image to the specified directory
                    $imageNames[] = $imageName; // Add image name to array
                }
                $ad->images = $imageNames;
            }

            $ad->save();
            return response()->json(['message' => 'Ad updated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }



    // ************************** Delete Ad **************************
    public function delete_ad($id)
    {
        try {
            $ad = Ad::findOrFail($id);
            $ad->delete();
            return response()->json(['message' => 'Ad deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
