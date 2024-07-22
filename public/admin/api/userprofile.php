<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['getUserInfo'])) {
    $userid = $_POST['getUserInfo'];
    $sql = "SELECT userinfo.*, userprofile.*,
            COALESCE(w.wishlist_count, 0) AS wishlist_count,
            COALESCE(o.orders_count, 0) AS orders_count,
            COALESCE(p.total_invested, 0.00) AS total_invested
            FROM userinfo
            INNER JOIN userprofile ON userinfo.userid = userprofile.userid
            LEFT JOIN (
            SELECT userid, COUNT(*) AS wishlist_count
            FROM wishlist
            GROUP BY userid
            ) AS w ON userinfo.userid = w.userid
            LEFT JOIN (
            SELECT userid, COUNT(*) AS orders_count
            FROM orders
            GROUP BY userid
            ) AS o ON userinfo.userid = o.userid
            LEFT JOIN (
            SELECT userid, SUM(amount) AS total_invested
            FROM payment
            GROUP BY userid
            ) AS p ON userinfo.userid = p.userid
            WHERE userinfo.userid = ?
            ";
    $st = $conn->prepare($sql);
    $st->bind_param('i', $userid);
    if ($st->execute()) {
        $result = $st->get_result();
        while ($row = $result->fetch_assoc()) {
            $userinfo['userinfo'][] = $row;
        }
        $sql = "SELECT * FROM deliveryaddress WHERE userid = ? AND status = 'Set'";
        $st = $conn->prepare($sql);
        $st->bind_param('i', $userid);
        $st->execute();
        $result = $st->get_result();
        while ($row = $result->fetch_assoc()) {
            $userinfo['defaultDeliveryAddress'][] = $row;
        }
        $st->close();
        $conn->close();

        echo json_encode($userinfo);
    }
}