<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;  // Ensure you import the Request class
use Illuminate\Support\Facades\Validator;  // Ensure you import the Validator class
use Illuminate\Support\Facades\Hash;  // Import the Hash facade for password hashing
use Illuminate\Support\Facades\Auth;  // Import the Auth facade for authentication

class AuthController extends Controller
{
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Image validation
        ]);
    
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');  // Store the image in the public storage
        }
    
        $user = new User;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->image = $imagePath;  // Save the image path to the database
        $user->save();
    
        return response()->json($user, 201);
    }
    

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {  // Add Request as a parameter
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {  // Use Auth::attempt for authentication
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
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

    
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
