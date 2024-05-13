<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function register(Request $request)
    {
        if ($request->expectsJson()) 
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(12))
            ]);
            $token = $user->createToken('register-token')->plainTextToken;
            
            $data = [
                'message' => 'User created successfully',
                'token' => $token
            ];
            $httpStatusCode = 200;
        } 
        else 
        {
            $data = [
                'message' => 'Bad Request'
            ];
            $httpStatusCode = 400;
        }
        
        return response()->json($data, $httpStatusCode);
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function login(Request $request)
    {
        if ($request->expectsJson())
        {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('login-token')->plainTextToken;

            $data = [
                'message' => 'User logged in successfully',
                'user_id' => $user->id,
                'token' => $token
            ];
            $httpStatusCode = 200;
        }
        else
        {
            $data = [
                'message' => 'Bad Request'
            ];
            $httpStatusCode = 400;
        }

        return response()->json($data, $httpStatusCode);
    }
    
}
