<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Query to fetch user profiles with the last order, total orders, and total spent
    $sql = "SELECT up.userid, up.profile_img, CONCAT(up.fname, ' ', up.lname) AS customer, u.email, u.username, u.password,up.datetime_created, u.usertype,
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
        $uname = decrypt($row['username']);
        $role = $row['usertype'];
        $pass = decrypt($row['password']);
        $totalOrders = $row['totalOrders'];
        $pic = $row['profile_img'] !== null ? $row['profile_img'] : 'default-pic.png';
        $totalSpent = '₱ ' . $row['totalSpent'];
        $date_created = date('M d, Y | h:iA', strtotime($row['datetime_created']));

        $tableRows[] = array(
            '<a class="d-flex align-items-center a-user" href="#!" data-userid="' . $userId . '">#' . $userId . '</a>',
            '<a class="d-flex align-items-center a-user" href="#!" data-userid="' . $userId . '"><h6 class="mb-0 ml-3">' . $customer . '</h6></a>',
            $email,
            $uname,
            $pass,
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
        );
    }

    // Return the table rows as JSON
    echo json_encode(array('data' => $tableRows));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['setRole'])) {
    $userId = $_POST['setRole'];
    $role = $_POST['role'];

    $sql = "UPDATE userinfo SET usertype = ? WHERE userid = ?";
    $st = $conn->prepare($sql);
    $st->bind_param('ss', $role, $userId);
    if ($st->execute()) {
        $res = array('status'=>'success', 'message' => "#$userId updated to $role");
        echo json_encode($res);
    } else {
        $res = array('status'=>'error', 'message' => "$userId failed to Update");
        echo json_encode($res);
    }
}