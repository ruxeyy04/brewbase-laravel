<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
include 'config.php';

// Query to fetch the number of orders data from the orders table
$query = "SELECT MONTH(order_date) AS month, COUNT(order_id) AS total_count FROM orders GROUP BY month";
$result = mysqli_query($conn, $query);

// Create an array to hold the number of orders data
$ordersData = array();

// Fetch and format the number of orders data
while ($row = mysqli_fetch_assoc($result)) {
    $ordersData[] = array(
        'month' => intval($row['month']),
        'count' => intval($row['total_count'])
    );
}

// Return the number of orders data as JSON
header('Content-Type: application/json');
echo json_encode($ordersData);
?>