<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function getUserInfo(Request $request)
    {
        if ($request->isMethod('post') && $request->has('getUserInfo') && $request->has('userid')) {
            $userid = $request->input('userid');

            $userInfo = UserInfo::select(
                'userinfos.*',
                'userprofiles.*',
                DB::raw('COALESCE(w.wishlist_count, 0) AS wishlist_count'),
                DB::raw('COALESCE(o.orders_count, 0) AS orders_count'),
                DB::raw('COALESCE(p.total_invested, 0.00) AS total_invested')
            )
                ->leftJoin('userprofiles', 'userinfos.userid', '=', 'userprofiles.userid')
                ->leftJoin(DB::raw('(SELECT userid, COUNT(*) AS wishlist_count FROM wishlists GROUP BY userid) AS w'), 'userinfos.userid', '=', 'w.userid')
                ->leftJoin(DB::raw('(SELECT userid, COUNT(*) AS orders_count FROM orders GROUP BY userid) AS o'), 'userinfos.userid', '=', 'o.userid')
                ->leftJoin(DB::raw('(SELECT userid, SUM(amount) AS total_invested FROM payments GROUP BY userid) AS p'), 'userinfos.userid', '=', 'p.userid')
                ->where('userinfos.userid', $userid)
                ->first();

            if ($userInfo) {
                $defaultDeliveryAddress = DeliveryAddress::where('userid', $userid)
                    ->where('status', 'Set')
                    ->get();

                $response = [
                    'userinfo' => array($userInfo->toArray()),
                    'defaultDeliveryAddress' => $defaultDeliveryAddress->toArray(),
                ];

                return response()->json($response);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post') && $request->has('changepass') && $request->has('userid')) {
            $oldpass = $request->input('changepass');
            $newpass = $request->input('newpass');
            $userid = $request->input('userid');

            $userExists = UserInfo::where('password', $oldpass)
                ->where('userid', $userid)
                ->exists();

            if ($userExists) {
                UserInfo::where('userid', $userid)
                    ->update(['password' => $newpass]);

                return response()->json(['status' => 'success', 'message' => 'Password Changed Successfully']);
            } else {
                return response()->json(['status' => 'wrongoldpass', 'message' => 'Wrong Old Password']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function updateAccount(Request $request)
    {
        if ($request->isMethod('post') && $request->has('updateAcc') && $request->has('userid')) {
            $userid = $request->input('userid');
            $user = $request->input('user');
            $email = $request->input('mail');

            $result = UserInfo::where('userid', $userid)
                ->update(['email' => $email, 'username' => $user]);

            if ($result > 0) {
                return response()->json(['status' => 'success', 'message' => 'Account Updated Successfully']);
            } else {
                return response()->json(['status' => 'nochanges', 'message' => 'No changes were made']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('post') && $request->has('updateProfile') && $request->has('userid')) {
            $userid = $request->input('userid');
            $fname = $request->input('fname');
            $midname = $request->input('midname');
            $lname = $request->input('lname');
            $suffix = $request->input('suffix');
            $gender = $request->input('gender');
            $country = $request->input('country');
            $zipcode = $request->input('zipcode');
            $birthdate = $request->input('birthdate');
            $region = $request->input('region');
            $province = $request->input('province');
            $city = $request->input('city');
            $barangay = $request->input('barangay');
            $streetname = $request->input('streetname');
            $phonenum = $request->input('phonenum');
            $telnum = $request->input('telnum');

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $profileImgExist = UserProfile::where('userid', $userid)->value('profile_img');

                // Directory to upload profile images
                $uploadDir = 'profileimg/';

                // Get the filename and extension of the uploaded photo
                $filename = $request->file('photo')->getClientOriginalName();
                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                // Generate a unique filename for the uploaded photo
                $newFilename = uniqid() . '.' . $extension;

                // Upload the new photo
                $request->file('photo')->storeAs('profileimg', $newFilename, 'public');

                // Remove the existing profile image
                if ($profileImgExist) {
                    Storage::disk('public')->delete($uploadDir . $profileImgExist);
                }
            } else {
                // No new photo uploaded
                $newFilename = null;
            }

            // Update the user profile
            UserProfile::updateOrCreate(
                ['userid' => $userid],
                [
                    'fname' => $fname,
                    'midname' => $midname,
                    'lname' => $lname,
                    'suffix' => $suffix,
                    'contact_no' => $phonenum,
                    'tel_no' => $telnum,
                    'gender' => $gender,
                    'birthdate' => $birthdate,
                    'street' => $streetname,
                    'barangay' => $barangay,
                    'city' => $city,
                    'province' => $province,
                    'region' => $region,
                    'country' => $country,
                    'postalcode' => $zipcode,
                    'profile_img' => $newFilename,
                ]
            );

            return response()->json(['status' => 'success', 'message' => 'Profile Updated Successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }
}
