<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // show_user
    public function show_user($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }

    // show_users
    public function show_users()
    {
        try {
            $users = User::with('ads', 'portfolios')->get();
            return response()->json(['status' => 'success', 'data' => $users]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }

    //update_user
    public function update_user(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->city = $request->city;
            $image = $request->image;
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/users'), $imageName);
                $user->image = $imageName;
            }
            $user->save();
            return response()->json(['status' => 'success', 'data' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }

    // delete_user
    public function delete_user($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success', 'data' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }
}
