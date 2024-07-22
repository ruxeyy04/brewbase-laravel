<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;
use Exception;

class DeliveryAddressController extends Controller
{
    public function getAddresses(Request $request)
    {
        if ($request->isMethod('post') && $request->has('userid') && $request->has('getAdd')) {
            $userid = $request->input('userid');

            $addresses = DeliveryAddress::where('userid', $userid)
                ->whereIn('status', ['Set', 'Not Set'])
                ->get();

            $addressCount = $addresses->count();

            $response = [
                'deliveryAdd' => $addresses->toArray(),
                'addressCount' => $addressCount,
            ];

            return response()->json($response);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function addDeliveryAddress(Request $request)
    {
        if ($request->isMethod('post') && $request->has('userid') && $request->has('addDelAdd')) {
            $userid = $request->input('userid');
            $fullname = $request->input('fullname', '');
            $contactnumber = $request->input('contactnumber1', '');
            $region = $request->input('region', '');
            $province = $request->input('province', '');
            $city = $request->input('city', '');
            $country = 'Philippines';
            $barangay = $request->input('barangay', '');
            $postal = $request->input('postal', '');
            $street = $request->input('street1', '');
            $addition_add = $request->input('addition_add', '');

            if (!empty($fullname) && !empty($contactnumber) && !empty($region) && !empty($province) && !empty($city) && !empty($barangay) && !empty($postal) && !empty($street) && !empty($addition_add)) {
                $addressCount = DeliveryAddress::where('userid', $userid)
                    ->whereIn('status', ['Set', 'Not Set'])
                    ->count();

                if ($addressCount >= 5) {
                    return response()->json(['status' => 'errormax', 'message' => 'Maximum address limit reached (5)']);
                }

                $status = $addressCount == 0 ? 'Set' : 'Not Set';

                $deliveryAddress = new DeliveryAddress();
                $deliveryAddress->userid = $userid;
                $deliveryAddress->fullname = $fullname;
                $deliveryAddress->phone_number = $contactnumber;
                $deliveryAddress->region = $region;
                $deliveryAddress->province = $province;
                $deliveryAddress->city = $city;
                $deliveryAddress->country = $country;
                $deliveryAddress->barangay = $barangay;
                $deliveryAddress->postalcode = $postal;
                $deliveryAddress->street = $street;
                $deliveryAddress->additionalinfo = $addition_add;
                $deliveryAddress->status = $status;

                if ($deliveryAddress->save()) {
                    return response()->json(['status' => 'success', 'message' => 'Data submitted successfully']);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Failed to insert data']);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Missing or empty required fields']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function getAddressForEdit(Request $request)
    {
        if ($request->isMethod('post') && $request->has('userid') && $request->has('addressEdit')) {
            $addressid = $request->input('addressEdit');

            $address = DeliveryAddress::where('deladd_id', $addressid)
                ->first();

            $response = [
                'deliveryAdd' => array($address->toArray()),
            ];

            return response()->json($response);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function updateDeliveryAddress(Request $request)
    {
        if ($request->isMethod('post') && $request->has('userid') && $request->has('updateDelAdd')) {
            $userid = $request->input('userid');
            $addressId = $request->input('updateDelAdd');
            $fullname = $request->input('fullname');
            $contactnumber = $request->input('contactnumber1');
            $region = $request->input('region');
            $province = $request->input('province');
            $city = $request->input('city');
            $barangay = $request->input('barangay');
            $postal = $request->input('postal');
            $street = $request->input('street1');
            $addition_add = $request->input('addition_add');

            if (!empty($fullname) && !empty($contactnumber) && !empty($region) && !empty($province) && !empty($city) && !empty($barangay) && !empty($postal) && !empty($street) && !empty($addition_add)) {
                $updateResult = DeliveryAddress::where('deladd_id', $addressId)
                    ->where('userid', $userid)
                    ->update([
                        'fullname' => $fullname,
                        'phone_number' => $contactnumber,
                        'region' => $region,
                        'province' => $province,
                        'city' => $city,
                        'barangay' => $barangay,
                        'postalcode' => $postal,
                        'street' => $street,
                        'additionalinfo' => $addition_add,
                    ]);

                if ($updateResult) {
                    return response()->json(['status' => 'success', 'message' => 'Delivery Address Updated Successfully']);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Failed to update data']);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Missing or empty required fields']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function setAsDefault(Request $request)
    {
        if ($request->isMethod('post') && $request->has('userid') && $request->has('setAsDefault')) {
            $delid = $request->input('setAsDefault');
            $userid = $request->input('userid');

            DB::beginTransaction();

            try {
                // Set status to 'Not Set' for all addresses of the user
                DeliveryAddress::where('userid', $userid)
                    ->where('status', '!=', 'Delete')
                    ->update(['status' => 'Not Set']);

                // Set status to 'Set' for the selected address
                DeliveryAddress::where('deladd_id', $delid)
                    ->where('userid', $userid)
                    ->update(['status' => 'Set']);

                DB::commit();

                return response()->json(['status' => 'success', 'message' => 'Delivery Address Set Successfully']);
            } catch (Exception $e) {
                DB::rollBack();

                return response()->json(['status' => 'error', 'message' => 'Failed to set delivery address as default']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function deleteDeliveryAddress(Request $request)
    {
        if ($request->isMethod('post') && $request->has('deleteDelAdd')) {
            $delid = $request->input('deleteDelAdd');

            $deleteResult = DeliveryAddress::where('deladd_id', $delid)
                ->update(['status' => 'Delete']);

            if ($deleteResult) {
                return response()->json(['status' => 'success', 'message' => 'Delivery Address Deleted Successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to delete delivery address']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }
}
