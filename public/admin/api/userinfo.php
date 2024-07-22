<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userid'])) {
  $userid = decrypt($_POST['userid']);
  $sql = "SELECT a.*, b.* FROM userinfo a JOIN userprofile b ON a.userid=b.userid WHERE a.userid = $userid";
  $result = $conn->query($sql);
  if ($result) {
    $user['userinfo'] = array();
    while ($row = $result->fetch_assoc()) {
      $user['userinfo'][] = $row;
    }
    echo json_encode($user);
  }
}
