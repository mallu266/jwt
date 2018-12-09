<?php

namespace ARJUN\JWT\CONTROLLERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JWTAUTHCONTROLLER extends Controller {

    protected $package;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:jwt', ['except' => ['login', 'signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login() {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('jwt')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Creciantials'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return response()->json(auth()->guard('jwt')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->guard('jwt')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken(auth()->guard('jwt')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) {
        return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->guard('jwt')->factory()->getTTL() * 60
        ]);
    }

    public function payload() {
        return auth()->guard('jwt')->payload();
    }

    public function signup(SignUpRequest $request) {
        $user = User::create($request->all());
        return $this->login($request);
    }

}
