<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->tipe_user = $request->tipe_user ?? 'pribadi';
        $user->save();
        
        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        
        return ResponseHelper::jsonResponse(true, 'Registrasi berhasil', $response, 201);
    }
    
    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            
            return ResponseHelper::jsonResponse(true, 'Login berhasil', $response, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Email atau password salah', null, 401);
        }
    }
    
    public function logout() {
        auth()->user()->tokens()->delete();
        return ResponseHelper::jsonResponse(true, 'Logout berhasil', null, 200);
    }
    
    public function profile() {
        $user = auth()->user();
        return ResponseHelper::jsonResponse(true, 'Data profile berhasil diambil', $user, 200);
    }
    
    public function updateProfile(Request $request) {
        $user = auth()->user();
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->tipe_user = $request->tipe_user ?? $user->tipe_user;
        $user->save();
        
        return ResponseHelper::jsonResponse(true, 'Profile berhasil diupdate', $user, 200);
    }
}