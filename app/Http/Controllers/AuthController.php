<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\compte;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role_id = 1 ;
            $user->save();

            session([
                'user_id' => $user->id,
                'role_id' =>$user->role_id,
                'name' =>$user->name,

            ]);

            $userCopmte = new Compte;
            $userCopmte->Solde = 100;
            $userCopmte->user_id= $user->id;
            $userCopmte->save();

            return response()->json([
                'message' => 'Utilisateur enregistré avec succès',
                'data'=>$user
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur est survenue lors de l\'enregistrement de l\'utilisateur: ' . $e->getMessage()], 500);
        }
    }



    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ]);

    try {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
                'test'=>Auth::user()
            ], 200);
        } else {
            return response()->json([
                'message' => 'Email ou password incorrecte'
            ], 401);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Something went wrong: ' . $e->getMessage()
        ], 500);
    }
}



}
