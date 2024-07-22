<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
include 'config.php';

// Query to fetch revenue data from the payment table
$query = "SELECT MONTH(payment_date) AS month, SUM(amount) AS total_amount FROM payment GROUP BY month";
$result = mysqli_query($conn, $query);

// Create an array to hold the revenue data
$revenueData = array();

// Fetch and format the revenue data
while ($row = mysqli_fetch_assoc($result)) {
    $revenueData[] = array(
        'month' => intval($row['month']),
        'amount' => intval($row['total_amount'])
    );
}

// Return the revenue data as JSON
header('Content-Type: application/json');
echo json_encode($revenueData);
?>