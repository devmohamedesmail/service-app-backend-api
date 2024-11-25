<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    // *********************** add new aticle **************************************************
    public function add_article(Request $request)
    {
        try {
            $article = new Article();
            $article->body = $request->body;
            $imageNames = [];
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/articles'), $imageName);
                    $imageNames[] = $imageName;
                }
                $article->images = $imageNames;
            }
            $article->save();
            return response()->json(['status' => 'success', 'data' => $article, 'message' => 'Article added successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }

    // ******************************************** get all articles **************************************
    public function show_articles()
    {
        try {
            $articles = Article::with('user')->orderBy('created_at', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $articles, 'message' => 'Articles retrieved successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }

    //**********************************************8 */ update_article **********************************
    public function update_article(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->body = $request->body;
            $imageNames = [];
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/articles'), $imageName);
                    $imageNames[] = $imageName;
                }
                $article->images = $imageNames;
            }
            $article->save();
            return response()->json(['status' => 'success', 'data' => $article, 'message' => 'Article updated successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }

    //************************************* */ delete_article **********************************************
    public function delete_article($id){
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return response()->json(['status' => 'success', 'message' => 'Article deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', $th->getMessage()]);
        }
    }
}
