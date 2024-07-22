<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getUserOrders(Request $request)
    {
        $response = [];
        $userid = $request->input('userid');

        $orders = DB::table('orders')->where('userid', $userid)->get();

        foreach ($orders as $order) {
            $orderArray = (array) $order; // Cast stdClass to array

            // Fetch total amount
            $orderArray['total_amount'] = OrderDetail::where('order_id', $order->order_id)->sum('totalAmount');

            // Fetch order items
            $orderArray['items'] = OrderDetail::select('order_details.*', 'products.prod_img', 'products.prod_name', 'addons.addons_name')
                ->leftJoin('products', 'order_details.prod_no', '=', 'products.prod_no')
                ->leftJoin('addons', 'order_details.addonsID', '=', 'addons.addonsID')
                ->where('order_id', $order->order_id)
                ->get()
                ->toArray();

            $response['orders'][] = $orderArray;
        }

        return response()->json($response);
    }

    public function confirmOrder(Request $request)
    {
        $orderid = $request->input('orderConfirm');

        $order = Order::find($orderid);

        if ($order && $order->status === "To Receive") {
            $order->status = 'Completed';

            if ($order->save()) {
                return response()->json(['status' => 'success', 'message' => 'Order is now Completed']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'There is a failure']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Cannot confirm the order']);
        }
    }



    public function cancelOrder(Request $request)
    {
        $orderid = $request->input('orderCancel');

        $order = Order::find($orderid);

        if ($order && $order->status === "Pending") {
            $order->status = 'Cancelled';

            if ($order->save()) {
                return response()->json(['status' => 'success', 'message' => 'Order is now Cancelled']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'There is an error while cancelling the order']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Cannot cancel the order']);
        }
    }
}
