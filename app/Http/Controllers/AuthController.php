<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json($user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! auth()->attempt($request->validated())) {
            return response()->json(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()
            ->user()
            ->createToken('authToken')->accessToken;

        return response()->json(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
