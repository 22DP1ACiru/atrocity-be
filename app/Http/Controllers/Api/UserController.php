<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'accountDescription' => $user->accountDescription,
            'followerCount' => $user->followerCount,
            'isAdmin' => $user->isAdmin,
            'profile_picture_url' => $user->profile_picture_url,
        ]);
    }

    public function currentUser(Request $request)
    {
        // Ensure the user is authenticated
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return response()->json($request->user());
    }
}

