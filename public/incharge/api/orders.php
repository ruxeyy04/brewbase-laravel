<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['getOrderDetail'])) {
    $sql = "SELECT o.order_id, p.amount, CONCAT(up.fname, ' ', up.lname) AS customer, up.userid, up.profile_img, o.status, COUNT(oi.order_id) AS total_items, p.payment_method, o.order_date, o.prepared_by
    FROM orders o
    LEFT JOIN userprofile up ON o.userid = up.userid
    LEFT JOIN payment p ON o.order_id = p.order_id
    LEFT JOIN orderdetail oi ON o.order_id = oi.order_id
    GROUP BY o.order_id
   ORDER BY CASE WHEN o.status = 'Pending' THEN 0 ELSE 1 END, o.status DESC;";
    
    $result = mysqli_query($conn, $sql);
    
    // Create an array to hold the table rows
    $tableRows = array();
    
    // Fetch each row from the result and add it to the tableRows array
    while ($row = mysqli_fetch_assoc($result)) {
        $orderId = $row['order_id'];
        $amount = '₱ ' . $row['amount'];
        $customer = $row['customer'];
        $userid = $row['userid'];
        $profileImg = $row['profile_img'] !== null ? '/../profileimg/' . $row['profile_img'] : '/../profileimg/default-pic.png';
        $status = $row['status'];
        $totalItems = $row['total_items'];
        $paymentMethod = $row['payment_method'];
        $orderDate = date('M d, Y, h:i A', strtotime($row['order_date']));
        $preparedBy = $row['prepared_by'] == '0' ? 'Being processed...' : $row['prepared_by'];
        $setText = $status === 'Available' ? 'Set to Not Available' : 'Set to Available';
        $btn1 = 'notClickable';
        $btn2 = 'notClickable';
        $btn3 = 'notClickable';
        $btn4 = 'notClickable';
        if ($status === 'Pending') {
            $btn1 = '';
            $btn4 = '';
        }elseif($status === 'Order Confirmed') {
            $btn2 = '';
        }elseif($status === 'On the Way') {
            $btn3 = '';
        } 
        $tableRows[] = array(
            "order_id" => '<a class="a-link orderDetail" href="#!" data-orderid="'.$orderId.'">' . '#' . $orderId . '</a>',
            "amount" => $amount,
            "customer" => $customer,
            "userid" => $userid,
            "profile_img" => $profileImg,
            "status" => $status,
            "total_items" => $totalItems,
            "payment_method" => $paymentMethod,
            "order_date" => $orderDate,
            "prepared_by" => $preparedBy,
            "action"=> '<button class="btn1 btn-outline-info dropdown-toggle product-btn" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
            <div class="dropdown-menu">
                <a class="dropdown-item text-info updateStat '.$btn1.'" href="#!" data-orderid="' . $orderId . '" data-status="Order Confirmed">Order Confirmation</a>
                <a class="dropdown-item text-warning updateStat '.$btn2.'" href="#!" data-orderid="' . $orderId . '" data-status="On the Way">On the Way</a>
                <a class="dropdown-item text-primary updateStat '.$btn3.'" href="#!" data-orderid="' . $orderId . '" data-status="To Receive">To Receive</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item text-danger updateStat '.$btn4.'" href="#!" data-orderid="' . $orderId . '" data-status="Cancel">Cancel</a>
            </div>'
        );
    }
    
    // Return the table rows as JSON
    echo json_encode(array('data' => $tableRows));
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['getOrderDetail'])) {
    $orderid = $_GET['orderid'];
    $sql = "SELECT * FROM `orders` WHERE order_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param('s', $orderid);
    $st->execute();
    $result = $st->get_result();
    $response['orders'] = array();
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];
        
            // Query to fetch the total amount
            $total_amount_sql = "SELECT SUM(totalAmount) AS total_amount, COUNT(order_id) as totalItems, SUM(prod_price * quantity) AS totalprodPrice, SUM(quantity *addonsPrice) AS totalAddons  FROM `orderdetail` WHERE order_id = ?";
            $total_amount_st = $conn->prepare($total_amount_sql);
            $total_amount_st->bind_param('s', $order_id);
            $total_amount_st->execute();
            $total_amount_result = $total_amount_st->get_result();
            $total_amount_row = $total_amount_result->fetch_assoc();
            $row['total_amount'] = $total_amount_row['total_amount'];
            $row['totalItems'] = $total_amount_row['totalItems'];
            $row['totalprodPrice'] = $total_amount_row['totalprodPrice'];
            $row['totalAddons'] = $total_amount_row['totalAddons'];
            // for payment
            $payment_sql = "SELECT a.*, b.* FROM `payment` a LEFT JOIN deliveryaddress b ON a.deladd_id=b.deladd_id WHERE order_id = ?";
            $payment_st = $conn->prepare($payment_sql);
            $payment_st->bind_param('s', $order_id);
            $payment_st->execute();
            $payment_result = $payment_st->get_result();
            $payment_row = $payment_result->fetch_assoc();
            $row['payment'] = $payment_row;
            if ($payment_row['payment_method'] === 'Direct Bank Transfer') {
                $payid = $payment_row['pay_id'];
                $card_sql = "SELECT * FROM `card_details` WHERE pay_id = ?";
                $card_st = $conn->prepare($card_sql);
                $card_st->bind_param('s', $payid);
                $card_st->execute();
                $card_result = $card_st->get_result();
                $card_row = $card_result->fetch_assoc();
                $row['card_details'] = $card_row;
            }
            // Query to fetch the order items
            $order_detail_sql = "SELECT a.*, b.prod_img, b.prod_name, c.addons_name 
                                 FROM `orderdetail` a 
                                 LEFT JOIN product b ON a.prod_no = b.prod_no 
                                 LEFT JOIN addons c ON a.addonsID = c.addonsID  
                                 WHERE order_id = ?";
            $order_detail_st = $conn->prepare($order_detail_sql);
            $order_detail_st->bind_param('s', $order_id);
            $order_detail_st->execute();
            $order_detail_result = $order_detail_st->get_result();
            $row['items'] = array();
            while ($item_row = $order_detail_result->fetch_assoc()) {
                $row['items'][] = $item_row;
            }
            $response['orders'][] = $row;
        }
    } else {
        $response = array('status'=>'error', 'message'=>'not found');
    }
    
    
    
    echo json_encode($response);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateOrder'])) {
    $ordid = $_POST['updateOrder'];
    $name = $_POST['name'];
    $stat = $_POST['status'];

    $sql = "UPDATE orders SET status = ?, prepared_by = ? WHERE order_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param('sss', $stat, $name, $ordid);
    if ($st->execute()) {
        $res = array('status'=>'success', 'message'=> "#$ordid is set to $stat");
        echo json_encode($res);
    } else {
        $res = array('status'=>'errpr', 'message'=> 'Failed to Update');
        echo json_encode($res);
    }
}
?>
