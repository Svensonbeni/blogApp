<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = new User();
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->password = Hash::make($request->password,['rounds'=>12]);
            $user->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => "L'utilisateur $user->nom a  bien été ajouté",
                'Données' => $user,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            
            // return response()->json([
            //     'status_code' => 200,
            //     'status_message' => "L'utilisateur $user->nom a  bien été ajouté",
            //     'Données' => $user,
            // ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
        if (auth()->attempt($request->only(['email','password']))) {
            $user =auth()->user();
            $token = $user->createToken('ma_CLE')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'status_message' => "$user->nom, vous êtes connecté",
                'user' => $user,
                'token' =>$token,
            ]);
        } else {
            return response()->json([
                'status_code' => 403,
                'status_message' => "Saisies invalides",
            ]);
        }
        
    }

    public function logout(Request $request)
    {
        // try {
            auth()->user()->tokens()->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Vous êtes déconnecté",
            ]);
        // } catch (Exception $e) {
        //     return response()->json($e);
        // }
    }
}
