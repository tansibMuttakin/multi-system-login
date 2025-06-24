<?php

namespace App\Services;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SsoService
{
    protected $jwt;
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    public function ssoLogin(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        /**
         * @var \App\Models\User
         */
        $user = Auth::user();

        $token = $this->jwt->fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email']),
            'redirect_url' => 'http://localhost:8001/sso-login?token=' . $token
        ]);
    }
}