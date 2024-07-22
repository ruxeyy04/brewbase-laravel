<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';

// Query to fetch user profiles with the last order, total orders, and total spent
$sql = "SELECT up.userid, up.profile_img, CONCAT(up.fname, ' ', up.lname) AS customer, u.email,
IFNULL(COUNT(DISTINCT o.order_id), 0) AS totalOrders,
IFNULL(SUM(p.amount), 0.00) AS totalSpent, up.city,
IFNULL(DATE_FORMAT(MAX(o.order_date), '%Y-%m-%d %H:%i:%s'), 'No Order Yet') AS lastOrderDate
FROM userprofile up
LEFT JOIN userinfo u ON up.userid = u.userid
LEFT JOIN orders o ON up.userid = o.userid
LEFT JOIN payment p ON o.order_id = p.order_id
GROUP BY up.userid
ORDER BY up.userid ASC

";

$result = mysqli_query($conn, $sql);

// Create an array to hold the table rows
$tableRows = array();

// Fetch each row from the result and add it to the tableRows array
while ($row = mysqli_fetch_assoc($result)) {
    $userId = $row['userid'];
    $customer = $row['customer'];
    $email = decrypt($row['email']);
    $totalOrders = $row['totalOrders'];
    $pic = $row['profile_img'] !== null ? $row['profile_img'] : 'default-pic.png';
    $totalSpent = '₱ ' . $row['totalSpent'];
    $city = $row['city'] !== null ? $row['city'] : '(Not Set)';
    $orderDate = $row['lastOrderDate'] !== 'No Order Yet' ? date('M d, Y | h:iA', strtotime($row['lastOrderDate'])) : 'No Order Yet';

    $tableRows[] = array(
        $userId,
        '<a class="d-flex align-items-center a-user" href="#!" data-userid="'.$userId.'">
        <div class="avatar"><img class="rounded-circle" src="/profileimg/'.$pic.'" alt="">
        </div><h6 class="mb-0 ml-3">'.$customer.'</h6></a>',
        $email,
        $totalOrders,
        $totalSpent,
        $city,
        $orderDate
    );
}

// Return the table rows as JSON
echo json_encode(array('data' => $tableRows));
?>
