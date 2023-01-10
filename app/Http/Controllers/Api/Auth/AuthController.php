<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Util\HandleResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HandleResponse;

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->respondUnauthorized([
                'data' => [],
                'message' => 'The given data was invalid',
            ]);
        }

        return $this->respondOk([
            'token' => $user->createToken(time())->plainTextToken,
            'user' => UserResource::make($user),
            'message' => 'Success',
        ]);
    }

    public function register(UserRegisterRequest $request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if ($user) {
            return $this->respondBad([
                'message' => 'Email already taken',
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
            $user->assignRole('customer');
        }

        return $this->respondOk([
            'token' => $user->createToken(time())->plainTextToken,
            'user' => UserResource::make($user),
            'message' => 'Success',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->respondNoContent();
    }
}
