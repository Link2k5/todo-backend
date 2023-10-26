<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if( ! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Email ou password inválido.'
            ], 403);
        }

        $device = substr($request->userAgent(), 0, 255);

        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken
        ]);
    }
}
