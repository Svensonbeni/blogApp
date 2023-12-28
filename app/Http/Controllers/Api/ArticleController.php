<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => "Liste des articles",
                'data' => Article::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateArticleRequest $request)
    {
        try {
            $article = new Article();
            $article->titre = $request->titre;
            $article->slug = $request->slug;
            $article->description = $request->description;
            $article->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => "L'article a été ajouté",
                'data' => $article,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditArticleRequest $request, Article $article)
    {
        try {
            $article->titre = $request->titre;
            $article->slug = $request->slug;
            $article->description = $request->description;
            $article->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => "L'article a été bien modifié",
                'data' => $article,
            ]);

        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete( Article $article)
    {
        try {
            $article->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => "L'article a bien été supprimé",
                'data' => $article,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    
    }
    
}
