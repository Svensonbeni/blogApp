<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Models\Article;
use App\Models\Comment;
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
            $this->authorize('create', Article::class);
            $article = new Article();
            $article->titre = $request->titre;
            $article->slug = $request->slug;
            $article->description = $request->description;
            // Liaison d'un user a un post
            $article->user_id = auth()->user()->id;
            $article->categorie_id = $request->categorie_id;
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
    public function show(Article $article)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => "Un article",
                'data' => $article,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        } 
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
            $this->authorize('update', Article::class);
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
            $this->authorize('delete', Article::class);
            $article->comment()->delete();
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
