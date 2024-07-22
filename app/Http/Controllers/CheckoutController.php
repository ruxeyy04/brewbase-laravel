<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\CartItem;
use App\Models\CardDetails;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function processCOD(Request $request)
    {
        $response = [];

        // Extract data from the request
        $userid = $request->input('userid');

        // Generate a random order ID
        $orderID = $this->generateRandomID();

        // Insert order record
        Order::create([
            'order_id' => $orderID,
            'status' => 'Pending',
            'userid' => $userid,
        ]);
        // Insert order details from cart
        $this->insertOrderDetailsFromCart($orderID, $userid);

        // Calculate total price
        $totalPrice = $this->getTotalPrice($orderID);

        // Get default delivery address
        $defaultAddress = DeliveryAddress::where('userid', $userid)
            ->where('status', 'Set')
            ->first();

        // Insert payments record
        $this->insertPaymentRecord($orderID, $userid, $defaultAddress->deladd_id, 'Cash on Delivery', $totalPrice);

        // Delete items from the cart
        CartItem::where('userid', $userid)->delete();

        $response = [
            'status' => 'success',
            'orderid' => $orderID,
        ];

        return response()->json($response);
    }

    public function processDirectBank(Request $request)
    {
        $response = [];

        // Extract data from the request
        $userid = $request->input('userid');
        $card_number = $request->input('card_number');
        $exp_date = $request->input('exp_date');
        $cv_code = $request->input('cv_code');
        $card_owner = $request->input('card_owner');

        if (!empty($card_number) && !empty($exp_date) && !empty($cv_code) && !empty($card_owner)) {
            // Generate a random order ID
            $orderID = $this->generateRandomID();

            // Insert order record
            Order::create([
                'order_id' => $orderID,
                'status' => 'Pending',
                'userid' => $userid,
            ]);

            // Insert order details from cart
            $this->insertOrderDetailsFromCart($orderID, $userid);

            // Calculate total price
            $totalPrice = $this->getTotalPrice($orderID);

            // Get default delivery address
            $defaultAddress = DeliveryAddress::where('userid', $userid)
                ->where('status', 'Set')
                ->first();

            $payID = $this->insertPaymentRecord($orderID, $userid, $defaultAddress->deladd_id, 'Direct Bank Transfer', $totalPrice);

            CardDetails::create([
                'pay_id' => $payID,
                'userid' => $userid,
                'cardholder_name' => $card_owner,
                'card_number' => $card_number,
                'expiration' => $exp_date,
                'cvv' => $cv_code,
            ]);


            // Delete items from the cart
            CartItem::where('userid', $userid)->delete();

            $response = [
                'status' => 'success',
                'orderid' => $orderID,
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Missing or empty required fields',
            ];
        }

        return response()->json($response);
    }

    private function generateRandomID($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomID = '';

        for ($i = 0; $i < $length; $i++) {
            $randomID .= $characters[rand(0, strlen($characters) - 1)];
        }

        $currentYear = date('Y');
        $randomID = $currentYear . $randomID;

        return $randomID;
    }

    private function insertOrderDetailsFromCart($orderID, $userid)
    {
        $cartItems = CartItem::join('products', 'cart_items.prod_no', '=', 'products.prod_no')
            ->join('addons', 'cart_items.addonsID', '=', 'addons.addonsID')
            ->select('cart_items.*', 'products.prod_price', 'addons.addons_price')
            ->where('cart_items.userid', $userid)
            ->get();

        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $orderID,
                'prod_no' => $item->prod_no,
                'quantity' => $item->quantity,
                'prod_price' => $item->prod_price,
                'addonsID' => $item->addonsID,
                'addonsPrice' => $item->addons_price,
                'totalAmount' => ($item->quantity * $item->prod_price) + ($item->quantity * $item->addons_price),
            ]);
        }
    }

    private function getTotalPrice($orderID)
    {
        return OrderDetail::where('order_id', $orderID)
            ->sum('totalAmount');
    }

    private function insertPaymentRecord($orderID, $userid, $deladd_id, $method, $amount)
    {
        $currentYear = date('Y');
        $payID = $currentYear . mt_rand(1000, 9999);

        Payment::insert([
            'pay_id' => $payID,
            'userid' => $userid,
            'order_id' => $orderID,
            'deladd_id' => $deladd_id,
            'payment_method' => $method,
            'amount' => $amount,
        ]);

        return $payID;
    }
}
