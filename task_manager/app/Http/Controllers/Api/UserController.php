<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Retrieve roles with their associated users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserRoles()
    {
        try {
            // Fetch roles with their associated users
            $roles = Role::with('users')->get();

            return response()->json([
                'roles' => $roles,
            ], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json([
                'error' => 'Failed to fetch user roles.',
            ], 500);
        }
    }

    /**
     * Assign a role to a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignRole(Request $request)
    {
        try {
            $validated = $request->validate([
                'role_id' => ['required', 'exists:roles,id'],
                'user_id' => ['required', 'exists:users,id'],
            ]);

            // Find the user by ID
            $user = User::findOrFail($validated['user_id']);

            // Assign the role to the user
            $user->role_id = $validated['role_id'];
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Role assigned successfully',
            ], 202);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->validator->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to assign role to user',
            ], 500);
        }
    }
}
