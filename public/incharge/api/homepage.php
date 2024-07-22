<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';

// Query to count total revenue
$sqlTotalRevenue = "SELECT SUM(amount) AS totalRevenue FROM payment";
$resultTotalRevenue = mysqli_query($conn, $sqlTotalRevenue);
$rowTotalRevenue = mysqli_fetch_assoc($resultTotalRevenue);
$totalRevenue = $rowTotalRevenue['totalRevenue'];

// Query to count total products
$sqlTotalProducts = "SELECT COUNT(prod_no) AS totalProducts FROM product WHERE status IN ('Available','Not Available')";
$resultTotalProducts = mysqli_query($conn, $sqlTotalProducts);
$rowTotalProducts = mysqli_fetch_assoc($resultTotalProducts);
$totalProducts = $rowTotalProducts['totalProducts'];

// Query to count total orders
$sqlTotalOrders = "SELECT COUNT(order_id) AS totalOrders FROM orders";
$resultTotalOrders = mysqli_query($conn, $sqlTotalOrders);
$rowTotalOrders = mysqli_fetch_assoc($resultTotalOrders);
$totalOrders = $rowTotalOrders['totalOrders'];

// Query to count total customers
$sqlTotalCustomers = "SELECT COUNT(userid) AS totalCustomers FROM userinfo";
$resultTotalCustomers = mysqli_query($conn, $sqlTotalCustomers);
$rowTotalCustomers = mysqli_fetch_assoc($resultTotalCustomers);
$totalCustomers = $rowTotalCustomers['totalCustomers'];

// Create an array to hold the total counts
$totalCounts = array(
    'totalRevenue' => $totalRevenue,
    'totalProducts' => $totalProducts,
    'totalOrders' => $totalOrders,
    'totalCustomers' => $totalCustomers
);

// Return the total counts as JSON
echo json_encode($totalCounts);
?>
