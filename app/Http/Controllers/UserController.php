<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers()
    {
    $users = User::all();
    return response()->json($users);
    }
    public function approvedUsersCount()
{
    $count = User::where('status', 'approved')->count();
    return response()->json(['count' => $count]);
}

// Add this method to get the count of pending users
public function getPendingUsersCount()
{
    $count = User::where('status', 'pending')->count();
    return response()->json(['count' => $count]);
}


    public function approveUser($id)
{
    $user = User::find($id);
    if ($user) {
        $user->status = 'approved';
        $user->save();
        return response()->json(['message' => 'User approved successfully']);
    }
    return response()->json(['message' => 'User not found'], 404);
}

public function declineUser($id)
{
    $user = User::find($id);
    if ($user) {
        $user->status = 'declined';
        $user->save();
        return response()->json(['message' => 'User declined successfully']);
    }
    return response()->json(['message' => 'User not found'], 404);
}
public function updateProfile(Request $request)
{
    $user = Auth::user();
    
    $validator = Validator::make($request->all(), [
        'firstname' => 'required|string|max:255',
        'middlename' => 'nullable|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
        $user->image = $imagePath;
    }

    $user->firstname = $request->firstname;
    $user->middlename = $request->middlename;
    $user->lastname = $request->lastname;
    $user->email = $request->email;
    $user->save();

    return response()->json($user);
}
}
