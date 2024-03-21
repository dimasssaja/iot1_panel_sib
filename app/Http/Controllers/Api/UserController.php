<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return DataTables::of($users)
            ->addColumn('action', function ($item) {
                return '<a class="btn btn btn-sm bg-primary" data-toggle="modal" data-target="#viewModal'.$item->id.'".><i class="far fa-eye p-1" style="color: white"></i></a>
                        <a class="btn btn btn-sm bg-warning" data-toggle="modal" data-target="#editModal'.$item->id.'".><i class="far fa-edit p-1" style="color: white"></i></a>
                        <a class="btn btn btn-sm bg-danger" data-toggle="modal" data-target="#deleteModal'.$item->id.'".><i class="fas fa-trash p-1" style="color: white"></i></a>';
            })
            ->addColumn('created_at', function ($item) {
                return Carbon::parse($item->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('updated_at', function ($item) {
                return Carbon::parse($item->updated_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $message = 'Add new user success';
            $success = true;
            $data = addResponseData($user, $message, $success);
            return response()->json($data, 201);
        } catch (\Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'success' => false
            ];
            return response()->json($result, 500);
        }
    }

     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $message = 'Get user details success';
                $success = true;
                $data = getResponseData($user, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'User not found';
                $success = false;
                $data = getResponseData($user, $message, $success);
                return response()->json($data, 404);
            }
        } catch (\Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'success' => false
            ];
            return response()->json($result, 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:8',
                'password_confirmation' => 'nullable|required_with:password|same:password',
            ]);

            if ($user) {
                if ($request->filled('password') && $request->filled('password_confirmation')) {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
                } else {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                    ]);
                }
                $message = 'Update user success';
                $success = true;
                $data = updateResponseData($user, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'User not found';
                $success = false;
                $data = updateResponseData($user, $message, $success);
                return response()->json($data, 404);
            }
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return response()->json($result, 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $user = User::find($id);
            if ($user) {
                $user->delete();
                $result = [
                    'message' => 'Delete user success',
                    'success' => true,
                ];
                return response()->json($result, 200);
            } else {
                $result = [
                    'message' => 'user not found',
                    'success' => false,
                ];
                return response()->json($result, 404);
            }
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($result, 500);
        }
    }
}
