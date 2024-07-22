<?php

namespace App\Http\Controllers;

use App\Models\Userinfo;
use App\Models\Userprofile;
use Illuminate\Http\Request;

class UserinfoController extends Controller
{
    public function profile(Request $request)
    {
        if ($request->isMethod('post') && $request->has('userid')) {
            $userid = $request->input('userid');

            $result = Userinfo::join('userprofiles as b', 'userinfos.userid', '=', 'b.userid')
                ->select('userinfos.*', 'b.*')
                ->where('userinfos.userid', $userid)
                ->get();

            if ($result) {
                $user['userinfo'] = $result->toArray();
                return response()->json($user);
            }
        }

        return response()->json(['error' => 'Invalid request.']);
    }
}
