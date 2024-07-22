<?php

namespace App\Http\Controllers;

use App\Models\Userinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $check = $request->input('check');
        $password = $request->input('password', '');

        $user = Userinfo::where(function ($query) use ($check) {
                $query->where('username', $check)
                    ->orWhere('email', $check);
            })
            ->first();

        if ($user) {
            if ($password && Hash::check($password, $user->password)) {
                $token = uniqid();
                // Password is correct
                $data = [
                    'token' => $token,
                    'userid' => $user->userid,
                    'status1' => 'successlogin',
                ];
            } elseif (!$password) {
                // No password provided
                $data = [
                    'status' => 'success',
                ];
            } else {
                // Password is incorrect
                $data = [
                    'status1' => 'failpass',
                    'message' => 'Password is Incorrect',
                ];
            }
        } else {
            // User not found
            $data = [
                'status' => 'fail',
                'message' => 'User not found',
            ];
        }

        return response()->json($data);
    }
}
