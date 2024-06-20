<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation rules
        $request->validate([
            'username' => 'required|string|min:3|unique:users,username,' . $id . ',userID',
            'accountDescription' => 'nullable|string|max:1000',
            'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        \Log::info('Update request data:', $request->all());

        if ($request->hasFile('profilePicture')) {
            $file = $request->file('profilePicture');
            $filePath = $file->store('uploads/profiles', 'public');
            $user->profilePictureLocation = $filePath;
        }

        $user->update($request->except(['profilePicture']));

        \Log::info('Updated user data:', $user->toArray());

        return response()->json($user);
    }

    public function currentUser(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $user = $request->user();
        $user->profilePictureLocation = url('uploads/profiles/' . basename($user->profilePictureLocation));
        return response()->json($user);
    }
}
