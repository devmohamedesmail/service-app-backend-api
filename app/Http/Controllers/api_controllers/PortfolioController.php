<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
     // add_portfolio
     public function add_portfolio(Request $request)
     {
         try {
             $portfolio = new Portfolio();
             $portfolio->user_id = $request->user_id;
             $portfolio->title = $request->title;
             $portfolio->description = $request->description;
             $image = $request->image;
 
             if ($image) {
                 $imageName = time() . '.' . $image->getClientOriginalExtension();
                 $image->move(public_path('uploads/portfolio'), $imageName);
                 $portfolio->image = $imageName;
             }
 
             $portfolio->link = $request->link;
             $portfolio->save();
             return response()->json(['status' => true, 'message' => 'Portfolio added successfully']);
         } catch (\Throwable $th) {
             return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
         }
     }
 
     public function show_user_portfolio($id)
     {
         try {
             $portfolio = Portfolio::where('user_id', $id)->get();
             return response()->json(['status' => true, 'message' => 'Portfolio fetched successfully', 'data' => $portfolio]);
         } catch (\Throwable $th) {
             return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
         }
     }
 
     // update_user_portfolio
     public function update_user_portfolio(Request $request, $id)
     {
 
 
         try {
             $portfolio = Portfolio::find($id);
             $portfolio->title = $request->title;
             $portfolio->description = $request->description;
             $image = $request->image;
 
             if ($image) {
                 $imageName = time() . '.' . $image->getClientOriginalExtension();
                 $image->move(public_path('uploads/portfolio'), $imageName);
                 $portfolio->image = $imageName;
             }
 
             $portfolio->link = $request->link;
             $portfolio->save();
             return response()->json(['status' => true, 'message' => 'Portfolio added successfully']);
         } catch (\Throwable $th) {
             return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
         }
     }
 
     // delete_user_portfolio
     public function delete_user_portfolio($id)
     {
         try {
             $portfolio = Portfolio::find($id);
             $portfolio->delete();
             return response()->json(['status' => true, 'message' => 'Portfolio deleted successfully']);
         } catch (\Throwable $th) {
             return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
         }
     }
 
     public function show_portfolios_data()
     {
         try {
             $portfolios = Portfolio::with('user')->get();
             return response()->json(['status' => true, 'message' => 'Portfolios data', 'data' => $portfolios]);
         } catch (\Throwable $th) {
             return response()->json(['status' => true, 'message' => 'There is Error', 'data' => $th]);
         }
     }
}
