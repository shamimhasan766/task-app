<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $token = $this->authService->register($validated);
        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'token'    => $token
        ]);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $token = $this->authService->login($validated);
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token'    => $token
        ]);
    }
}
