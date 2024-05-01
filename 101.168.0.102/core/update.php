<?php
// Include your database connection code here
include '../../include/connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type'])) {
    // Check if the action type is for updating order
    if ($_POST['type'] === 'edit_order' && isset($_POST['order_id'])) {
        // Get form data
        $order_id = $_POST['order_id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];

        // Update order details in the database
        $update_query = "UPDATE orders SET name = '$name', address = '$address', phone = '$phone', status = '$status' WHERE id = '$order_id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            // Redirect back to the page with success message
            header("Location: ../index.php?success=Order updated successfully");
            exit();
        } else {
            // Redirect back to the page with error message
            header("Location: ../index.php?error=Failed to update order");
            exit();
        }
    }else if($_POST['type'] === 'edit_cart' && isset($_POST['cart_id']) && isset($_POST['new_qty']) && isset($_POST['order_id'])) {
        $cart_id = $_POST['cart_id'];
        $new_qty = $_POST['new_qty'];
        $order_id = $_POST['order_id'];
    
        // Perform the update query to update the quantity of the cart item
        $update_query = "UPDATE cart SET qty = '$new_qty' WHERE id = '$cart_id'";
        $result = mysqli_query($conn, $update_query);
    
        if ($result) {
            // Fetch cart_ids from the orders table where id = $order_id
            $order_query = "SELECT cart_ids FROM orders WHERE id = '$order_id'";
            $order_result = mysqli_query($conn, $order_query);
            $order_row = mysqli_fetch_assoc($order_result);
            $cart_ids = $order_row['cart_ids'];
    
            // Explode the cart IDs around comma to get an array
            $cart_ids_array = explode(',', $cart_ids);
    
            // Initialize total price
            $total_price = 0;
    
            // Calculate total amount based on every cart item
            foreach ($cart_ids_array as $cart_id) {
                $cart_item_query = "SELECT product.p_price, cart.qty FROM cart join product on cart.product_id=product.id WHERE cart.id = '$cart_id'";
                $cart_item_result = mysqli_query($conn, $cart_item_query);
                $cart_item_row = mysqli_fetch_assoc($cart_item_result);
                $total_price += $cart_item_row['p_price'] * $cart_item_row['qty'];
            }
    
            // Update the total amount in the orders table
            $update_query2 = "UPDATE orders SET total_amount = '$total_price' WHERE id = '$order_id'";
            $result2 = mysqli_query($conn, $update_query2);
    
            if ($result2) {
                // Redirect back to the page with success message
                header("Location: ../index.php?success=Cart item updated successfully");
                exit();
            } else {
                // Redirect back to the page with error message
                header("Location: ../index.php?error=Failed to update cart item total amount");
                exit();
            }
        } else {
            // Redirect back to the page with error message
            header("Location: ../index.php?error=Failed to update cart item quantity");
            exit();
        }
    }
    else {
        // Redirect back to the page with error message if invalid action type
        header("Location: ../index.php?error=Invalid action type");
        exit();
    } 
}
else {
    // Redirect back to the page with error message if request method is not POST or action type is not set
    header("Location: ../index.php?error=Invalid request");
    exit();
}
?>
