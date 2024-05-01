<?php
include '../../include/connection.php'; // Include your database connection file

// Check if form is submitted
if(isset($_POST['type']) && $_POST['type'] == "add-product"){
    // Sanitize input data
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $generic_name = mysqli_real_escape_string($conn, $_POST['generic_name']);
    $main_category = mysqli_real_escape_string($conn, $_POST['main_category']);
    $manufacturer = mysqli_real_escape_string($conn, $_POST['manufacturer']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // File upload handling
    if(isset($_FILES['image'])){
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_size = $image['size'];
        $image_error = $image['error'];

        // Check if file is uploaded successfully
        if($image_error === 0){
            $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $allowed = array('jpg', 'jpeg', 'png');

            // Check if file type is allowed
            if(in_array($image_ext, $allowed)){
                // Check if file size is within limit (2MB)
                if($image_size <= 2000000){
                    $new_image_name = uniqid('', true). ".". $image_ext;
                    $destination = "../../images/product/". $new_image_name; // Adjust destination path as per your file structure

                    // Move uploaded file to destination
                    if(move_uploaded_file($image_tmp, $destination)){
                        // Insert product details into database
                        $insert_query = "INSERT INTO product (
                            main_category_id,
                            brand,
                            generic,
                            manufacturer,
                            image,
                            description,
                            p_price,
                            status
                        ) VALUES (
                            '$main_category',
                            '$brand_name',
                            '$generic_name',
                            '$manufacturer',
                            '$new_image_name',
                            '$description',
                            '$price',
                            '0'
                        )";
                        $insert_query_result = mysqli_query($conn, $insert_query);

                        // Check if insertion was successful
                        if($insert_query_result){
                            // Redirect with success message
                            header("Location: ../index.php?success=Product added successfully");
                            exit();
                        }else{
                            // Redirect with error message
                            header("Location: ../index.php?error=" . mysqli_error($conn));
                            exit();
                        }
                    }else{
                        // Redirect with error message
                        header("Location: ../index.php?error=Error uploading image");
                        exit();
                    }
                }else{
                    // Redirect with error message
                    header("Location: ../index.php?error=Image size is too big");
                    exit();
                }
            }else{
                // Redirect with error message
                header("Location: ../index.php?error=Image type not allowed");
                exit();
            }
        }else{
            // Redirect with error message
            header("Location: ../index.php?error=Image error");
            exit();
        }
    }else{
        // Redirect with error message
        header("Location: ../index.php?error=No image uploaded");
        exit();
    }
}

// Check if the form is submitted
if(isset($_POST['type']) && $_POST['type'] == "sale-product") {
    // Sanitize input data
    $medicine_id = mysqli_real_escape_string($conn, $_POST['medicine_id']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $p_price = mysqli_real_escape_string($conn, $_POST['price']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
    

    // Prepare and execute the SQL statement to insert into the sale table
    $insert_query = "INSERT INTO sale (product_id, qty, p_price, discount, t_price, date) 
                     VALUES ('$medicine_id', '$qty', '$p_price', '$discount', '$total_price', NOW())";

    $insert_result = mysqli_query($conn, $insert_query);

    // Check if the insertion was successful
    if($insert_result) {
        // Redirect back to the form page with success message
        header("Location: ../index.php?success=Sale%20completed%20successfully");
        exit();
    } else {
        // Redirect back to the form page with error message
        header("Location: ../index.php?error=Error%20occurred%20while%20inserting%20data");
        exit();
    }
}

if(isset($_POST['type']) && $_POST['type'] == "purchase-product") {
    //Sanitize input data
    $medicine_id = mysqli_real_escape_string($conn, $_POST['medicine_id']);
    $vendor_name = mysqli_real_escape_string($conn, $_POST['vendor']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $production_date = mysqli_real_escape_string($conn, $_POST['production_date']);
    $expiry_date = mysqli_real_escape_string($conn, $_POST['expiry_date']);
    $unit_price = mysqli_real_escape_string($conn, $_POST['unit_price']);
    $purchase_date = mysqli_real_escape_string($conn, $_POST['purchase_date']);
    if(!$purchase_date) {
        $purchase_date = date("Y-m-d");
    }
    $total_price = $unit_price * $qty;
    

    // Prepare and execute the SQL statement to insert into the sale table
    $insert_query = "INSERT INTO stock (product_id, vendor, qty, production_date, expiry_date, unit_price, total_price, purchase_date) 
                     VALUES ('$medicine_id', '$vendor_name', '$qty', '$production_date', '$expiry_date', '$unit_price', '$total_price', '$purchase_date')";

    $insert_result = mysqli_query($conn, $insert_query);

    // Check if the insertion was successful
    if($insert_result) {
        // Redirect back to the form page with success message
        header("Location: ../index.php?success=Purchase%20completed%20successfully");
        exit();
    } else {
        // Redirect back to the form page with error message
        header("Location: ../index.php?error=Error%20occurred%20while%20inserting%20data");
        exit();
    }
}







// Check if the form is submitted
if (isset($_POST['action']) && $_POST['action'] === 'add_user') {
    // Extract user data from the form
    $u_name = $_POST['u_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $u_role = $_POST['u_role'];

    // You may want to perform some validation here before inserting the data into the database

    // Insert the user data into the database
    $query = "INSERT INTO user (u_name, email, password, phone, address, u_role) 
                VALUES ('$u_name', '$email', '$password', '$phone', '$address', '$u_role')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // User added successfully, redirect back to the page with success message
        header("Location: ../index.php?success=User added successfully");
        exit();
    } else {
        // Failed to add user, redirect back to the page with error message
        header("Location: ../index.php?error=Failed to add user");
        exit();
    }
} else {
    // Invalid action or action not set, redirect back to the page with error message
    header("Location: ../index.php?error=Invalid action");
    exit();
}



?>