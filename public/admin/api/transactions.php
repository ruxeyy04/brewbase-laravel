<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';

// Query to fetch transaction data
$sql = "SELECT up.*, p.pay_id, CONCAT(up.fname, ' ', up.lname) AS customer_name, p.payment_method, o.order_id, o.status, p.payment_date, p.amount
        FROM payment p
        INNER JOIN orders o ON p.order_id = o.order_id
        INNER JOIN userprofile up ON up.userid = o.userid";
$result = mysqli_query($conn, $sql);

// Create an array to hold the table rows
$tableRows = array();
$totalAmount = 0;

// Fetch each row from the result and add it to the tableRows array
while ($row = mysqli_fetch_assoc($result)) {
    $userid = $row['userid'];
    $paymentId = $row['pay_id'];
    $profimg = $row['profile_img'] !== null ? $row['profile_img'] : 'default-pic.png';
    $customerName = $row['customer_name'];
    $paymentMethod = $row['payment_method'];
    $orderId = $row['order_id'];
    $status = $row['status'];
    $paymentDate = date('M d, Y, h:i A', strtotime($row['payment_date']));
    $amount = $row['amount'];

    $totalAmount += $amount;

    $tableRows[] = array(
        'payment_id' => $paymentId,
        'customer_name' => '<a class="d-flex align-items-center a-user" href="#!" data-userid="'.$userid.'">
        <div class="avatar"><img class="rounded-circle" src="/profileimg/'.$profimg.'" alt="">
        </div><h6 class="mb-0 ml-3">'.$customerName.'</h6></a>',
        'payment_method' => $paymentMethod,
        'order_id' => '<a class="a-link orderDetail" href="#!" data-orderid="'.$orderId.'">' . '#' . $orderId . '</a>',
        'status' => $status,
        'payment_date' => $paymentDate,
        'amount' => '₱ ' . $amount
    );
}

// Calculate the total amount and format it
$totalAmountFormatted = '₱ ' . number_format($totalAmount, 2);

// Create the footer row
$footerRow = array(
    array(
        'colspan' => 5,
        'class' => 'text-right',
        'rowspan' => 1,
        'value' => 'Total: '
    ),
    array(
        'colspan' => 2,
        'rowspan' => 1,
        'value' => $totalAmountFormatted
    )
);

// Return the table rows and footer as JSON
echo json_encode(array('data' => $tableRows, 'footer' => $footerRow));
?>
