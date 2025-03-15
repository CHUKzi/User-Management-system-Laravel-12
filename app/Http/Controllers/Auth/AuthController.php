<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            //new LoginDTO($request->all());

            $lastSegment = $request->segment(count($request->segments()));

            $credentials = $request->only('email', 'password');

            $guardType = $lastSegment;

            if ($guardType != 'users') {
                return response()->json(['error' => 'Invalid guard type'], 400);
            }

            config(['auth.guards.' . $guardType . '.driver' => 'session']);

            if (Auth::guard($guardType)->attempt($credentials)) {
                config(['auth.guards.' . $guardType . '.driver' => 'passport']);
                $user = Auth::guard($guardType)->user();

                $token = $user->createToken('Personal Access Token')->accessToken;

                return response()->json([
                    'user' => $user,
                    'token' => $token,
                ]);
            } else {
                return response()->json([
                    'error' => 'Authentication failed',
                    'message' => 'Invalid username or password',
                ], 403);
            }
        } catch (ValidationException $error) {
            return response()->json([
                'error' => $error,
                'message' => $error->getMessage(),
            ], 403);
        }
    }
}
