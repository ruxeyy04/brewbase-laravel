<?php

namespace App\Http\Controllers;


use App\Models\Userinfo;
use App\Models\Userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'user' => 'required|string|unique:userinfos,username|max:255',
            'email' => 'required|email|unique:userinfos,email|max:255',
            'pass' => 'required|string|min:8|confirmed'
        ]);
        $id =  date('Y') . rand(100000000, 999999999);
        // Create Userinfo
        $userinfo = Userinfo::create([
            'userid' => $id,
            'email' => $request->input('email'),
            'username' => $request->input('user'),
            'password' => bcrypt($request->input('pass'))
        ]);

        // Create Userprofile
        Userprofile::create([
            'userid' => $userinfo->userid,
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname')
        ]);

        // Registration success response
        return response()->json(['message' => 'User registered successfully'], 200);
    }

    public function checkUser(Request $request)
    {
        $response = ['userstat' => false];
    
        if ($request->isMethod('post') && $request->has('user')) {
            $user = $request->input('user');
            $userInfo = DB::table('userinfos')->where('username', $user)->first();
            if ($userInfo) {
                $response['userstat'] = true;
            }
        } elseif ($request->isMethod('post') && $request->has('email')) {
            $user = $request->input('email');
            $userInfo = DB::table('userinfos')->where('email', $user)->first();
            if ($userInfo) {
                $response['userstat'] = true;
            }
        }
    
        return response()->json($response);
    }
}
