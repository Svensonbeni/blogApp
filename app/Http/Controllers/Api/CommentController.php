<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\EditCommentRequest;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;



class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CreateCommentRequest $request)
    {
        try {
            $this->authorize('create', Comment::class);
            $comment = new Comment();
            $comment->titre = $request->titre;
            $comment->slug = $request->slug;
            $comment->description = $request->description;
            // Liaison d'un user a un post
            $comment->user_id = auth()->user()->id;
            $comment->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => "L'comment a été ajouté",
                'data' => $comment,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $Comment)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => "Un Comment",
                'data' => $Comment,
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
    public function update(EditCommentRequest $request, Comment $comment)
    {
        try {
            $this->authorize('update', Comment::class);
            $comment->titre = $request->titre;
            $comment->slug = $request->slug;
            $comment->description = $request->description;
            $comment->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => "Ce commentaire a été bien modifié",
                'data' => $comment,
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

    public function delete( Comment $comment)
    {
        try {
            $comment->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Ce commentaire a bien été supprimé",
                'data' => $comment,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    
    }
}
