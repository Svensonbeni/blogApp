<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategorieRequest;
use App\Http\Requests\EditCategorieRequest;
use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => "Toutes les categories",
                'data' => Categorie::all(),
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
    public function store(CreateCategorieRequest $request)
    {
        try {
            $this->authorize('create', Categorie::class);
            $categorie = new Categorie();
            $categorie->libele = $request->libele;
            $categorie->description = $request->description;
            // Liaison d'un user a un post
            //$categorie->user_id = auth()->user()->id;
            $categorie->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => "Categorie ajouté",
                'data' => $categorie,
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
    public function update(EditCategorieRequest $request, Categorie $categorie)
    {
        try {
            $this->authorize('update', Categorie::class);
            $categorie->libele = $request->libele;
            $categorie->description = $request->description;
            $categorie->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => "Catégorie modifiée",
                'data' => $categorie,
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

    public function delete( Categorie $categorie)
    {
        try {
            $this->authorize('delete', Categorie::class);
            $categorie->articles()->delete();
            $categorie->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Categorie supprimée avec tous les articles ",
                'data' => $categorie,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    
    }
}
