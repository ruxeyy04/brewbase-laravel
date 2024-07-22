<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{

    public function getOrderDetails(Request $request)
    {
        
        if ($request->method() === 'GET' && $request->has('orderid')) {
            $orderId = $request->input('orderid');

            // Query to fetch order details
            $orderDetails = DB::table('orders')
                ->where('order_id', $orderId)
                ->get();

            $response['orders'] = [];

            if ($orderDetails->count() > 0) {
                foreach ($orderDetails as $order) {
                    // Query to fetch total amount
                    $totalAmount = DB::table('order_details')
                        ->where('order_id', $order->order_id)
                        ->selectRaw('SUM(totalAmount) AS total_amount, COUNT(order_id) as totalItems, 
                            SUM(prod_price * quantity) AS totalprodPrice, 
                            SUM(quantity * addonsPrice) AS totalAddons')
                        ->first();

                    $order->total_amount = $totalAmount->total_amount;
                    $order->totalItems = $totalAmount->totalItems;
                    $order->totalprodPrice = $totalAmount->totalprodPrice;
                    $order->totalAddons = $totalAmount->totalAddons;

                    // Query to fetch payments details
                    $payment = DB::table('payments as a')
                        ->leftJoin('delivery_addresses as b', 'a.deladd_id', '=', 'b.deladd_id')
                        ->where('order_id', $order->order_id)
                        ->first();

                    $order->payment = $payment;

                    if ($payment->payment_method === 'Direct Bank Transfer') {
                        // Query to fetch card details
                        $cardDetails = DB::table('card_details')
                            ->where('pay_id', $payment->pay_id)
                            ->first();

                        $order->card_details = $cardDetails;
                    }

                    // Query to fetch order items
                    $orderItems = DB::table('order_details as a')
                        ->leftJoin('products as b', 'a.prod_no', '=', 'b.prod_no')
                        ->leftJoin('addons as c', 'a.addonsID', '=', 'c.addonsID')
                        ->where('order_id', $order->order_id)
                        ->select('a.*', 'b.prod_img', 'b.prod_name', 'c.addons_name')
                        ->get();

                    $order->items = $orderItems;

                    $response['orders'][] = $order;
                }
            } else {
                $response = ['status' => 'error', 'message' => 'not found'];
            }



            // Return the response as JSON
            return response()->json($response);
        }
    }


}
