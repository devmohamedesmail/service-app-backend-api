<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{
    // **************** Add New Ads ****************
    public function add_ads(Request $request)
    {

        try {
            $ad = new Ad();
            $category = Category::find($request->category_id);
            $ad->user_id = $request->user_id;
            $ad->category_id = $request->category_id;
            $ad->title = $request->title;
            $ad->category = $category->name;
            $ad->description = $request->description;
            $ad->link = $request->link;
            $ad->position = $request->position;
            $ad->type = $request->type;
            $ad->phone = $request->phone;
            $ad->email = $request->email;
            $ad->website = $request->website;
            $ad->whatsup = $request->whatsup;
            $ad->city = $request->city;
            $ad->country = $request->country;
            $ad->price = $request->price;
            
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/ads'), $imageName);
                $ad->image = $imageName;
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
            $ads = Ad::with('user', 'category')->get();
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
            $ad->user_id = $request->user_id;
            $ad->category_id = $request->category_id;
            $ad->title = $request->title;
            $ad->description = $request->description;
            $ad->link = $request->link;
            $ad->position = $request->position;
            $ad->type = $request->type;
            $ad->type = $request->type;
            $ad->phone = $request->phone;
            $ad->email = $request->email;
            $ad->website = $request->website;
            $ad->whatsup = $request->whatsup;
            $ad->address = $request->address;
            $ad->city = $request->city;
            $ad->state = $request->state;
            $ad->country = $request->country;
            $ad->price = $request->price;
            $ad->price_unit = $request->price_unit;
            $ad->price_type = $request->price_type;
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/ads'), $imageName);
                $ad->image = $imageName;
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
