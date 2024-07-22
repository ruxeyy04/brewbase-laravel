<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Userinfo;
use App\Models\CardDetails;
use App\Models\OrderDetail;
use App\Models\Userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function homepage()
    {
        return view('admin.home');
    }
    public function orders()
    {
        return view('admin.orders');
    }
    public function transactions()
    {
        return view('admin.transactions');
    }
    public function user()
    {
        return view('admin.user');
    }
    public function summaryValues()
    {
        // Query to count total revenue
        $totalRevenue = DB::table('payments')->sum('amount');

        // Query to count total products
        $totalProducts = DB::table('products')->whereIn('status', ['Available', 'Not Available'])->count();

        // Query to count total orders
        $totalOrders = DB::table('orders')->count();

        // Query to count total customers
        $totalCustomers = DB::table('userinfos')->count();

        // Create an array to hold the total counts
        $totalCounts = [
            'totalRevenue' => $totalRevenue,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
        ];

        // Return the total counts as JSON
        return response()->json($totalCounts);
    }
    public function getRevenueData()
    {
        $revenueData = DB::table('payments')
            ->selectRaw('MONTH(payment_date) as month, SUM(amount) as amount')
            ->groupBy('month')
            ->get();

        return response()->json($revenueData);
    }

    public function getOrderData()
    {
        $ordersData = DB::table('orders')
            ->selectRaw('MONTH(order_date) as month, COUNT(order_id) as count')
            ->groupBy('month')
            ->get();

        return response()->json($ordersData);
    }
    public function customerList()
    {
        $customerData = DB::table('userprofiles as up')
            ->select(
                'up.userid',
                'up.fname',
                'up.lname',
                'up.profile_img', // Include profile_img in the SELECT clause
                'u.email',
                DB::raw("CONCAT(up.fname, ' ', up.lname) AS customer"),
                DB::raw("IFNULL(COUNT(DISTINCT o.order_id), 0) AS totalOrders"),
                DB::raw("IFNULL(SUM(p.amount), 0.00) AS totalSpent"),
                'up.city',
                DB::raw("IFNULL(DATE_FORMAT(MAX(o.order_date), '%Y-%m-%d %H:%i:%s'), 'No Order Yet') AS lastOrderDate")
            )
            ->leftJoin('userinfos as u', 'up.userid', '=', 'u.userid')
            ->leftJoin('orders as o', 'up.userid', '=', 'o.userid')
            ->leftJoin('payments as p', 'o.order_id', '=', 'p.order_id')
            ->groupBy('up.userid', 'up.fname', 'up.lname', 'u.email', 'up.profile_img', 'up.city') // Include profile_img in the GROUP BY clause
            ->orderBy('up.userid', 'ASC')
            ->get();


        $tableRows = $customerData->map(function ($row) {
            $userId = $row->userid;
            $customer = $row->customer;
            $email = $row->email;
            $totalOrders = $row->totalOrders;
            $pic = $row->profile_img !== null ? $row->profile_img : 'default-pic.png';
            $totalSpent = '₱ ' . $row->totalSpent;
            $city = $row->city !== null ? $row->city : '(Not Set)';
            $orderDate = $row->lastOrderDate !== 'No Order Yet' ? date('M d, Y | h:iA', strtotime($row->lastOrderDate)) : 'No Order Yet';

            return [
                $userId,
                '<a class="d-flex align-items-center a-user" href="#!" data-userid="' . $userId . '">
                    <div class="avatar"><img class="rounded-circle" src="/profileimg/' . $pic . '" alt=""></div>
                    <h6 class="mb-0 ml-3">' . $customer . '</h6>
                </a>',
                $email,
                $totalOrders,
                $totalSpent,
                $city,
                $orderDate,
            ];
        });

        // Return the table rows as JSON
        return response()->json(['data' => $tableRows]);
    }
    public function userProfile(Request $request)
    {
        if ($request->isMethod('post') && $request->has('getUserInfo')) {
            $userid = $request->input('getUserInfo');

            $userInfo = DB::table('userinfos')
                ->select(
                    'userinfos.*',
                    'userprofiles.*',
                    DB::raw('COALESCE(w.wishlist_count, 0) AS wishlist_count'),
                    DB::raw('COALESCE(o.orders_count, 0) AS orders_count'),
                    DB::raw('COALESCE(p.total_invested, 0.00) AS total_invested')
                )
                ->join('userprofiles', 'userinfos.userid', '=', 'userprofiles.userid')
                ->leftJoin(DB::raw('(SELECT userid, COUNT(*) AS wishlist_count FROM wishlists GROUP BY userid) AS w'), 'userinfos.userid', '=', 'w.userid')
                ->leftJoin(DB::raw('(SELECT userid, COUNT(*) AS orders_count FROM orders GROUP BY userid) AS o'), 'userinfos.userid', '=', 'o.userid')
                ->leftJoin(DB::raw('(SELECT userid, SUM(amount) AS total_invested FROM payments GROUP BY userid) AS p'), 'userinfos.userid', '=', 'p.userid')
                ->where('userinfos.userid', '=', $userid)
                ->get();

            $defaultDeliveryAddress = DB::table('delivery_addresses')
                ->select('*')
                ->where('userid', '=', $userid)
                ->where('status', '=', 'Set')
                ->get();

            return response()->json(['userinfo' => $userInfo, 'defaultDeliveryAddress' => $defaultDeliveryAddress]);
        }
    }

    public function getOrders(Request $request)
    {
        if ($request->isMethod('get') && !$request->has('getOrderDetail')) {
            $orders = DB::table('orders')->select(
                'orders.order_id',
                'payments.amount',
                'userprofiles.fname',
                'userprofiles.lname',
                'userprofiles.userid',
                'userprofiles.profile_img',
                'orders.status',
                'orders.order_date',
                'orders.prepared_by',
                'payments.payment_method'
            )
                ->leftJoin('userprofiles', 'orders.userid', '=', 'userprofiles.userid')
                ->leftJoin('payments', 'orders.order_id', '=', 'payments.order_id')
                ->leftJoin('order_details', 'orders.order_id', '=', 'order_details.order_id')
                ->groupBy('orders.order_id', 'userprofiles.fname', 'userprofiles.lname', 'userprofiles.userid', 'userprofiles.profile_img', 'orders.status', 'orders.order_date', 'orders.prepared_by', 'payments.payment_method', 'payments.amount')
                ->orderByRaw("CASE WHEN orders.status = 'Pending' THEN 0 ELSE 1 END, orders.status DESC")
                ->get();



            $tableRows = [];
            foreach ($orders as $order) {
                $orderId = $order->order_id;
                $amount = '₱ ' . $order->amount;
                $customer = $order->fname . ' ' . $order->lname;
                $userid = $order->userid;
                $profileImg = $order->profile_img !== null ? '/profileimg/' . $order->profile_img : '/profileimg/default-pic.png';
                $status = $order->status;
                $paymentMethod = $order->payment_method;
                $totalItems = OrderDetail::where('order_id', $orderId)->count();
                $orderDate = date('M d, Y, h:i A', strtotime($order->order_date));
                $preparedBy = $order->prepared_by == '0' ? 'Being processed...' : $order->prepared_by;

                $tableRows[] = [
                    "order_id" => '<a class="a-link orderDetail" href="#!" data-orderid="' . $orderId . '">' . '#' . $orderId . '</a>',
                    "amount" => $amount,
                    "customer" => $customer,
                    "userid" => $userid,
                    "profile_img" => $profileImg,
                    "status" => $status,
                    "total_items" => $totalItems,
                    "payment_method" => $paymentMethod,
                    "order_date" => $orderDate,
                    "prepared_by" => $preparedBy,
                    "action" => '<button class="btn1 btn-outline-info dropdown-toggle product-btn" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-info updateStat" href="#!" data-orderid="' . $orderId . '" data-status="Order Confirmed">Order Confirmation</a>
                            <a class="dropdown-item text-warning updateStat" href="#!" data-orderid="' . $orderId . '" data-status="On the Way">On the Way</a>
                            <a class="dropdown-item text-primary updateStat" href="#!" data-orderid="' . $orderId . '" data-status="To Receive">To Receive</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger updateStat" href="#!" data-orderid="' . $orderId . '" data-status="Cancel">Cancel</a>
                        </div>'
                ];
            }

            return response()->json(['data' => $tableRows]);
        }
    }

    public function getOrderDetail(Request $request)
    {
        if ($request->method() === 'GET' && $request->has('getOrderDetail')) {
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
                    $payments = DB::table('payments as a')
                        ->leftJoin('delivery_addresses as b', 'a.deladd_id', '=', 'b.deladd_id')
                        ->where('order_id', $order->order_id)
                        ->first();

                    $order->payment = $payments;

                    if ($payments->payment_method === 'Direct Bank Transfer') {
                        // Query to fetch card details
                        $cardDetails = DB::table('card_details')
                            ->where('pay_id', $payments->pay_id)
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

    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post') && $request->has('updateOrder')) {
            $orderId = $request->input('updateOrder');
            $name = $request->input('name');
            $status = $request->input('status');

            try {
                $order = Order::find($orderId);
                $order->status = $status;
                $order->prepared_by = $name;
                $order->save();

                $response = ['status' => 'success', 'message' => "#$orderId is set to $status"];
                return response()->json($response);
            } catch (\Exception $e) {
                $response = ['status' => 'error', 'message' => 'Failed to Update'];
                return response()->json($response);
            }
        }
    }
    public function getTransactions(Request $request)
    {
        // Query to fetch transaction data
        $transactions = Payment::select(
            'userprofiles.*',
            'payments.pay_id',
            DB::raw("CONCAT(userprofiles.fname, ' ', userprofiles.lname) AS customer_name"),
            'payments.payment_method',
            'orders.order_id',
            'orders.status',
            'payments.payment_date',
            'payments.amount'
        )
            ->join('orders', 'payments.order_id', '=', 'orders.order_id')
            ->join('userprofiles', 'userprofiles.userid', '=', 'orders.userid')
            ->orderByRaw("CASE WHEN orders.status = 'Pending' THEN 0 ELSE 1 END, orders.status DESC")
            ->get();

        // Create an array to hold the table rows
        $tableRows = [];
        $totalAmount = 0;

        // Fetch each row from the result and add it to the tableRows array
        foreach ($transactions as $transaction) {
            $userid = $transaction->userid;
            $paymentId = $transaction->pay_id;
            $profimg = $transaction->profile_img !== null ? $transaction->profile_img : 'default-pic.png';
            $customerName = $transaction->customer_name;
            $paymentMethod = $transaction->payment_method;
            $orderId = $transaction->order_id;
            $status = $transaction->status;
            $paymentDate = date('M d, Y, h:i A', strtotime($transaction->payment_date));
            $amount = $transaction->amount;

            $totalAmount += $amount;

            $tableRows[] = [
                'payment_id' => $paymentId,
                'customer_name' => '<a class="d-flex align-items-center a-user" href="#!" data-userid="' . $userid . '">
                    <div class="avatar"><img class="rounded-circle" src="/profileimg/' . $profimg . '" alt=""></div>
                    <h6 class="mb-0 ml-3">' . $customerName . '</h6></a>',
                'payment_method' => $paymentMethod,
                'order_id' => '<a class="a-link orderDetail" href="#!" data-orderid="' . $orderId . '">' . '#' . $orderId . '</a>',
                'status' => $status,
                'payment_date' => $paymentDate,
                'amount' => '₱ ' . $amount,
            ];
        }

        // Calculate the total amount and format it
        $totalAmountFormatted = '₱ ' . number_format($totalAmount, 2);

        // Create the footer row
        $footerRow = [
            [
                'colspan' => 5,
                'class' => 'text-right',
                'rowspan' => 1,
                'value' => 'Total: ',
            ],
            [
                'colspan' => 2,
                'rowspan' => 1,
                'value' => $totalAmountFormatted,
            ],
        ];

        // Return the table rows and footer as JSON
        return response()->json(['data' => $tableRows, 'footer' => $footerRow]);
    }

    public function getUserProfiles(Request $request)
    {
        header("Content-Type: application/json");

        // Query to fetch user profiles with the last order, total orders, and total spent
        $users = Userprofile::select(
            'userprofiles.userid',
            'userprofiles.profile_img',
            DB::raw("CONCAT(userprofiles.fname, ' ', userprofiles.lname) AS customer"),
            'userinfos.email',
            'userinfos.username',
            'userinfos.password',
            'userinfos.usertype',
            'userprofiles.created_at',
            DB::raw("IFNULL(COUNT(DISTINCT orders.order_id), 0) AS totalOrders"),
            DB::raw("IFNULL(SUM(payments.amount), 0.00) AS totalSpent"),
            'userprofiles.city',
            DB::raw("IFNULL(DATE_FORMAT(MAX(orders.order_date), '%Y-%m-%d %H:%i:%s'), 'No Order Yet') AS lastOrderDate")
        )
            ->leftJoin('userinfos', 'userprofiles.userid', '=', 'userinfos.userid')
            ->leftJoin('orders', 'userprofiles.userid', '=', 'orders.userid')
            ->leftJoin('payments', 'orders.order_id', '=', 'payments.order_id')
            ->groupBy('userprofiles.userid', 'userprofiles.profile_img', 'userprofiles.fname', 'userprofiles.lname', 'userinfos.email', 'userinfos.username', 'userinfos.password', 'userinfos.usertype', 'userprofiles.created_at', 'userprofiles.city')
            ->orderBy('userprofiles.userid', 'ASC')
            ->get();


        // Create an array to hold the table rows
        $tableRows = [];

        // Fetch each row from the result and add it to the tableRows array
        foreach ($users as $user) {
            $userId = $user->userid;
            $customer = $user->customer;
            $email = $user->email;
            $uname = $user->username;
            $role = $user->usertype;
            $pass = $user->password;
            $totalOrders = $user->totalOrders;
            $pic = $user->profile_img !== null ? $user->profile_img : 'default-pic.png';
            $totalSpent = '₱ ' . $user->totalSpent;
            $date_created = date('M d, Y | h:iA', strtotime($user->created_at));

            $tableRows[] = [
                '<a class="d-flex align-items-center a-user" href="#!" data-userid="' . $userId . '">#' . $userId . '</a>',
                '<a class="d-flex align-items-center a-user" href="#!" data-userid="' . $userId . '"><h6 class="mb-0 ml-3">' . $customer . '</h6></a>',
                $email,
                $uname,
                $role,
                $date_created,
                '<button class="btn1 btn-outline-info dropdown-toggle product-btn" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item text-info setRole text-primary ' . ($role === 'Customer' ? 'notClickable' : '') . '" href="#!" data-userid="' . $userId . '" data-role="Customer">Set to Customer</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item text-warning setRole text-warning ' . ($role === 'In-Charge' ? 'notClickable' : '') . '" href="#!" data-userid="' . $userId . '" data-role="In-Charge">Set to In-Charge</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item text-primary setRole text-danger ' . ($role === 'Admin' ? 'notClickable' : '') . '" href="#!" data-userid="' . $userId . '" data-role="Admin">Set to Admin</a>
                </div>'
            ];
        }

        // Return the table rows as JSON
        return response()->json(['data' => $tableRows]);
    }

    public function setRole(Request $request)
    {
        $userId = $request->input('setRole');
        $role = $request->input('role');

        $user = Userinfo::find($userId);
        if (!$user) {
            $res = ['status' => 'error', 'message' => 'User not found'];
            return response()->json($res);
        }

        $user->usertype = $role;
        $user->save();

        $res = ['status' => 'success', 'message' => "#$userId updated to $role"];
        return response()->json($res);
    }
}
