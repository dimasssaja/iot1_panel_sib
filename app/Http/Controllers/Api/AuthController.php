<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $result = [
                'message' => 'Login success',
                'success' => true,
                'data' => $user,
                'token' => $user->createToken('api_login')->plainTextToken
            ];

            return response()->json($result, 200);
        } catch (ValidationException $e) {
            // Handle validation exception
            $errors = $e->errors();

            $result = [
                'message' => 'Login failed',
                'success' => false,
                'errors' => $errors,
            ];

            return response()->json($result, 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            // Handle other exceptions
            $result = [
                'message' => 'An error occurred while processing your request',
                'success' => false,
                'error' => $e->getMessage(),
            ];

            return response()->json($result, 500); // 500 Internal Server Error
        }
    }

    /**
     * Logout method
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $result = [
            'message' => 'Logout success',
            'success' => true,
        ];
        return response()->json($result, 200);
    }


}
