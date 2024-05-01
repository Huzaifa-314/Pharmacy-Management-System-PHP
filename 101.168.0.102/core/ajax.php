<?php
// Include your database connection file
include '../../include/connection.php';

if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Fetch the retail price from the product table based on the product ID
    $query = "SELECT p_price FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['p_price'];
    } else {
        echo "Price not found";
    }
}
?>
