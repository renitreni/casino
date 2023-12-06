<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function authenticate(AuthenticateRequest $authenticateRequest)
    {
        $user = User::where('email', $authenticateRequest->email)->first();

        if (! $user || ! Hash::check($authenticateRequest->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user->tokens()->delete();

        return $user->createToken($authenticateRequest->getClientIp())->plainTextToken;
    }

    public function checkToken()
    {
        return auth()->user();
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return ['message' => 'success'];
    }
}
