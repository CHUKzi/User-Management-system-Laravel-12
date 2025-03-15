<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userList()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            "data" => $users,
            'message' => null,
            'error' => null,
        ], 200);
    }

    /**
     * Get a single user by ID.
     */
    public function getUser(User $user)
    {
        return response()->json([
            'success' => true,
            "data" => $user,
            'message' => null,
            'error' => null,
        ], 200);
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Created successfully!',
                'data' => $user,
                'error' => null,
            ],
            201
        );
    }

    public function updateUser(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json(
            [
                'success' => true,
                'message' => 'Updated successfully!',
                'data' => $user,
                'error' => null,
            ],
            201
        );
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Deleted successfully!',
                'data' => null,
                'error' => null,
            ],
            200
        );
    }
}
