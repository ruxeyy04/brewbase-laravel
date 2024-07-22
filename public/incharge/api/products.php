<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query to fetch product data
    $sql = "SELECT *
        FROM product WHERE status IN ('Available', 'Not Available')";
    $result = mysqli_query($conn, $sql);

    // Create an array to hold the table rows
    $tableRows = array();

    // Fetch each row from the result and add it to the tableRows array
    while ($row = mysqli_fetch_assoc($result)) {
        $productNo = $row['prod_no'];
        $productName = $row['prod_name'];
        $prodimg = $row['prod_img'];
        $category = $row['category'];
        $description = $row['prod_description'];
        $status = $row['status'];
        $date = date('F d, Y', strtotime($row['prod_date']));
        $price = '₱ ' . $row['prod_price'];
        $setText = $status === 'Available' ? 'Set to Not Available' : 'Set to Available';
        $setColor = $status === 'Available' ? 'text-info' : 'text-success';
        // Limit the description to 200 characters
        if (strlen($description) > 50) {
            $description = substr($description, 0, 50) . '...';
        }

        $tableRows[] = array(
            $productNo,
            '<div class="admin-image-preview">
            <div class="item_image mr-3" style="width: 70px;">
                <img src="/../productimg/' . $prodimg . '" alt="product_image">
            </div>
            <h3 class="item_title">' . $productName . '</h3>
        </div>',
            $category,
            $description,
            $status,
            $date,
            $price,
            '<button class="btn1 btn-outline-info dropdown-toggle product-btn" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
        <div class="dropdown-menu">
            <a class="dropdown-item updateProd" href="#!" data-prodid="' . $productNo . '">Update</a>
            <a class="dropdown-item '.$setColor.' setProd" href="#!" data-prodid="' . $productNo . '" data-status="'.$status.'">'.$setText.'</a>
            <div role="separator" class="dropdown-divider"></div>
            <a class="dropdown-item text-danger delProd" href="#!" data-prodid="' . $productNo . '">Delete</a>
        </div>'
        );
    }

    // Return the table rows as JSON
    echo json_encode(array('data' => $tableRows));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addProd'])) {
    $prodName = $_POST['prodName'];
    $category = $_POST['category'];
    $prodesc = $_POST['prodesc'];
    $prodPrice = $_POST['prodPrice'];
    $prodDate = $_POST['prodDate'];
    $status = $_POST['status'];

    // Check if all inputs and file are provided
    if (!empty($prodName) && !empty($category) && !empty($prodesc) && !empty($prodPrice) && !empty($prodDate) && !empty($status) && isset($_FILES['prodpic'])) {
        $file = $_FILES['prodpic'];

        // File details
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Check if file upload was successful
        if ($fileError === 0) {
            $img_ex = pathinfo($fileName, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $newFilename = uniqid("product-", true).'.'.$img_ex_lc;
            $fileDestination = '../../../productimg/' . $newFilename;
            move_uploaded_file($_FILES['prodpic']['tmp_name'], $fileDestination);

            $sql = "INSERT INTO product (category, prod_name, prod_description, prod_date, prod_price, prod_img, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $category, $prodName, $prodesc, $prodDate, $prodPrice, $newFilename, $status);
            $stmt->execute();

            $response = array(
                'status' => 'success',
                'message' => 'Product Added Successfully',
                'title' => 'Success'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'The Product Photo is Required',
                'title' => 'Error'
            );
            echo json_encode($response);
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Fill in the missing fields',
            'title' => 'Error'
        );
        echo json_encode($response);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProd'])) {
    $prodID = $_POST['updateProd'];
    $sql = "SELECT * FROM product WHERE prod_no = ?";
    $st = $conn->prepare($sql);
    if(!$st) {
        $error = $conn->error; 
        $res = array('status' => 'error', 'message' => 'Failed to prepare SELECT statement: ' . $error, 'title'=>'There is an Error');
        echo json_encode($res);
    } else {
        $st->bind_param('s', $prodID);
        $st->execute();
        $result = $st->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $prod['prod'] = $row;
            echo json_encode($prod);
        } 
    }
   

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_Prod'])) {
    $prodid = $_POST['update_Prod'];
    $prodName = $_POST['prodName'];
    $category = $_POST['category'];
    $prodesc = $_POST['prodesc'];
    $prodPrice = $_POST['prodPrice'];
    $prodDate = $_POST['prodDate'];
    $status = $_POST['status'];

    // Check if all inputs are provided
    if (!empty($prodName) && !empty($category) && !empty($prodesc) && !empty($prodPrice) && !empty($prodDate) && !empty($status)) {

        // Check if a new image file is uploaded
        if (isset($_FILES['prodpic']) && !empty($_FILES['prodpic']['name'])) {
            $file = $_FILES['prodpic'];

            // File details
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            // Check if file upload was successful
            if ($fileError === 0) {
                $img_ex = pathinfo($fileName, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $newFilename = uniqid("product-", true) . '.' . $img_ex_lc;
                $fileDestination = '../../../productimg/' . $newFilename;
                move_uploaded_file($fileTmpName, $fileDestination);

                // Remove the current product image from the directory folder
                $sqlSelect = "SELECT prod_img FROM product WHERE prod_no = ?";
                $stmtSelect = $conn->prepare($sqlSelect);
                $stmtSelect->bind_param('i', $prodid);
                $stmtSelect->execute();
                $stmtSelect->store_result();
                $stmtSelect->bind_result($oldFilename);
                $stmtSelect->fetch();

                if ($stmtSelect->num_rows > 0) {
                    if (!empty($oldFilename)) {
                        $oldFilePath = '../../../productimg/' . $oldFilename;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                }

                $stmtSelect->close();

                $sqlUpdate = "UPDATE product SET category=?, prod_name=?, prod_description=?, prod_date=?, prod_price=?, prod_img=?, status=? WHERE prod_no=?";

                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param('sssssssi', $category, $prodName, $prodesc, $prodDate, $prodPrice, $newFilename, $status, $prodid);
                $stmtUpdate->execute();

                if ($stmtUpdate->affected_rows > 0) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Product Updated Successfully',
                        'title' => 'Success'
                    );
                    echo json_encode($response);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'There is no changes have made',
                        'title' => 'No Changes'
                    );
                    echo json_encode($response);
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Failed to upload the new product photo',
                    'title' => 'Error'
                );
                echo json_encode($response);
            }
        } else {
            // No new image uploaded, update the product without changing the image
            $sqlUpdate = "UPDATE product SET category=?, prod_name=?, prod_description=?, prod_date=?, prod_price=?, status=? WHERE prod_no=?";

            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param('ssssssi', $category, $prodName, $prodesc, $prodDate, $prodPrice, $status, $prodid);
            $stmtUpdate->execute();

            if ($stmtUpdate->affected_rows > 0) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Product Updated Successfully',
                    'title' => 'Success'
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'There is no changes have made',
                    'title' => 'No Changes'
                );
                echo json_encode($response);
            }
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Fill in the missing fields',
            'title' => 'Error'
        );
        echo json_encode($response);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_prod'])) {
    $stat = $_POST['status_prod'];
    $prodid = $_POST['prodid'];

    if ($stat === 'Available') {
        $sql = "UPDATE product SET status = 'Not Available' WHERE prod_no = ?";
        $st = $conn->prepare($sql);
        $st->bind_param('i', $prodid);
        if ($st->execute()) {
            $response = array(
                'status'=>'success',
                'title'=>'Success',
                'icon'=>'info',
                'message'=>'Product is Set to Not Avaiable'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status'=>'error',
                'title'=>'Failed to Update',
                'message'=>'There is an error to set the product. Please Try Again.'
            );
            echo json_encode($response);
        }
    } else {
        $sql = "UPDATE product SET status = 'Available' WHERE prod_no = ?";
        $st = $conn->prepare($sql);
        $st->bind_param('i', $prodid);
        if ($st->execute()) {
            $response = array(
                'status'=>'success',
                'title'=>'Success',
                'icon'=>'success',
                'message'=>'Product is Set to Avaiable'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status'=>'error',
                'title'=>'Failed to Update',
                'message'=>'There is an error to set the product. Please Try Again.'
            );
            echo json_encode($response);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delProd'])) {
    $prodid = $_POST['delProd'];
    $sql = "UPDATE product SET status = 'Deleted' WHERE prod_no = ?";
        $st = $conn->prepare($sql);
        $st->bind_param('i', $prodid);
        if ($st->execute()) {
            $response = array(
                'status'=>'success',
                'title'=>'Success',
                'icon'=>'info',
                'message'=>'Product is Successfully Deleted'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status'=>'error',
                'title'=>'Failed to Update',
                'message'=>'Product is Failed Delete'
            );
            echo json_encode($response);
        }
}