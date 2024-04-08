<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // public function index()
    // {
    //     return view('login');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only(
            'username',
            'email',
            'password'
        );

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'message' => 'Login success',
            'user' => Auth::guard('api')->user(),
            'token' => $token
        ]);
        // $credentials = $request->only('username', 'email', 'password');

        // //cek valid credentials 
        // if (Auth::guard('api')->attempt($credentials)) {
        //     return response()->json([
        //         'message' => 'Login success',
        //         'user' => Auth::guard('api')->user()
        //     ]);
        // }

        // return redirect()->back()
        //     ->with('error', 'Invalid credentials')
        //     ->withInput();
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'message' => 'Logout success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to logout: ' . $e->getMessage()
            ], 500);
        }
        // Auth::guard('api')->logout();
        // return response()->json([
        //     'message' => 'Logout success'
        // ]);
        // return redirect()->route('admin.auth.index');
    }
}
