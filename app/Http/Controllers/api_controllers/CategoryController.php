<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //  **************** Add New  Category ****************
    public function add_category(Request $request)
    {

        try {
            $category = new Category();
            $category->nameEn = $request->nameEn;
            $category->nameAr = $request->nameAr;
            $category->slug = $request->slug;
            $category->description = $request->description;
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $imageName);
                $category->image = $imageName;
            }

            $category->save();
            return response()->json(['status' => 'success', 'message' => 'Category Added Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }





    

    //  **************** Get All Categories ****************
    public function show_categories()
    {
        try {
            $categories =  Category::with('ads.user')->get();
            return response()->json(['status' => 'success', 'data' => $categories]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }






    // **************** Update Single Category ****************
    public function update_category(Request $request, $id)
    {
        try {
            $category =  Category::findOrFail($id);
            $category->nameEn = $request->nameEn;
            $category->nameAr = $request->nameAr;
            $category->slug = $request->slug;
            $category->description = $request->description;
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $imageName);
                $category->image = $imageName;
            }

            $category->save();
            return response()->json(['status' => 'success', 'message' => 'Category Added Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }




    // **************** Delete Single Category ****************
    public function delete_category($id)
    {
        try {
            $category =  Category::findOrFail($id);
            $category->delete();
            return response()->json(['status' => 'success', 'message' => 'Category Deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

}
