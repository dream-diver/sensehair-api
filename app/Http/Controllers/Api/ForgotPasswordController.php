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
        try {
            $credentials = request()->validate(['email' => 'required|email']);
            $user = User::where('email',$credentials["email"])->first();
            if ($user) {
                Password::sendResetLink($credentials);
                return response()->json([ "status"=>"success", "msg" => 'Reset password link sent on your email. It may take several minutes to appear in your inbox']);
            }
            else{
                return response()->json([ "status"=>"error","msg" => 'There is no user associated with this email! Please try again!']);
            }
        } catch (\Throwable $th) {
            return response()->json([ "status"=>"error","msg" => 'Error sending reset password link! Please try again!']);
        }
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
