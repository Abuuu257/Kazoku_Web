<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class AuthApiController extends Controller
{
    /**
     * Create User, Login and Return Token
     * @param Request $request
     * @return User
     */
    public function register(Request $request)
    {
        try {
            // Validated
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
             'status' => true,
             'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Update User Profile
     * @param Request $request
     * @return User
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user();

            $validateUser = Validator::make($request->all(), [
                'name' => 'sometimes|required',
                'username' => 'sometimes|required|unique:users,username,' . $user->id,
                'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
                'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            // Update basic fields
            if ($request->has('name')) {
                $user->name = $request->name;
            }
            if ($request->has('username')) {
                $user->username = $request->username;
            }
            if ($request->has('email')) {
                $user->email = $request->email;
            }

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($user->profile_image && \Storage::disk('public')->exists($user->profile_image)) {
                    \Storage::disk('public')->delete($user->profile_image);
                }

                // Store new image
                $path = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $path;
            }

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Profile Updated Successfully',
                'user' => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
