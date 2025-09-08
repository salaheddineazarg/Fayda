<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Implementations\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {

    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $data = $this->authService->login($credentials);
        return response()->json([
            'success' => (bool)$data,
            'data' => $data ? $data : null ,
            'message'=>$data ? 'Login Success' : 'Login Failed'
        ],$data ? 200 : 400);
    }
    public function register(Request $request)
    {
        $validated= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone_number' => 'sometimes|nullable|regex:/^[0-9+\-\s()]*$/|min:8|max:20',
            'password' => 'required','string','min:8',
            'role' => 'required|in:user,CUSTOMER,VENDOR'
        ]);
        $data = $this->authService->register($validated);

        return response()->json([
            'success' => (bool)$data,
            'data' => $data ? $data : null ,
            'message'=>$data ? 'Register Success' : 'Register Failed'
        ],$data ? 201 : 400);
    }

    public function logout(){
       $valid = $this->authService->logout();
       return response()->json([
           'success' => (bool)$valid,
           'message'=>$valid ? 'Logout Success' : 'Logout failed'
       ],$valid ? 200 : 400);
    }

}
