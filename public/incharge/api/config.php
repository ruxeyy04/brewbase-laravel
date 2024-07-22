<?php 
$conn = new mysqli("localhost", "root", "", "brewbase");

if($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
function encrypt($message) {
    $key = 'brewbase@1922@0411RxPSK1';
    $encryptedMessage = "";
    $length = strlen($message);

    for ($i = 0; $i < $length; $i++) {
        $encryptedMessage .= chr(ord($message[$i]) + ord($key[$i % strlen($key)]));
    }

    return base64_encode($encryptedMessage);
}

function decrypt($message) {
    $key = 'brewbase@1922@0411RxPSK1';
    $message = base64_decode($message);
    $decryptedMessage = "";
    $length = strlen($message);

    for ($i = 0; $i < $length; $i++) {
        $decryptedMessage .= chr(ord($message[$i]) - ord($key[$i % strlen($key)]));
    }

    return $decryptedMessage;
}
?>