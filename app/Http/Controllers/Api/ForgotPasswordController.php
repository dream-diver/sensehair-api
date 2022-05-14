<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        // $user = User::where('email',request('email'))->first();
        try {
            $reset_password_status = Password::reset($credentials, function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            });

            if ($reset_password_status == Password::INVALID_TOKEN) {
                return response()->json(["msg" => "Invalid token provided"], 400);
            }
        } catch (\Throwable $th) {
            throw $th;
        }


        return view('auth.reset_success');
    }
}
