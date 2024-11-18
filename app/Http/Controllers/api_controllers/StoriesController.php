<?php

namespace App\Http\Controllers\api_controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    // *********************************** add_user_story ************************************
    public function add_user_story(Request $request, $id)
    {
       
        try {
            $story = new Story();
        $story->user_id = $id;
        $image = $request->file("image");
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/stories'), $imageName);
            $story->media = $imageName;
        }
        $story->save();
        return response()->json(['status' => true, 'data' => $story, 'message' => 'Story added successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
        }
    }

    // ***************************************** show_stories_data ***************************************
    public function show_stories_data(){
        try {
            $stories = User::with('stories')->get();
            return response()->json(['status' => true, 'data' => $stories, 'message' => 'stories Fetched successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
        }
    }


    // ***************************************** delete_user_story ***************************************
    public function delete_user_story($id){
        try {
            $story = Story::find($id);
            $story->delete();
            return response()->json(['status' => true, 'message' => 'Story deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
        }
    }
}
