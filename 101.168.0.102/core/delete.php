<?php
// Include your database connection code here
include '../../include/connection.php'; 

if (isset($_GET['id']) && isset($_GET['type']) && $_GET['type'] === 'delete') {
    $order_id = $_GET['id'];

    // Perform deletion of order from the database
    $delete_query = "DELETE FROM orders WHERE id = '$order_id'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        // Redirect back to the page with success message
        header("Location: ../index.php?success=Order deleted successfully");
        exit();
    } else {
        // Redirect back to the page with error message
        header("Location: ../index.php?error=Failed to delete order");
        exit();
    }
}else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type']) && $_POST['type'] === 'delete_cart' && isset($_POST['cart_id']) && isset($_POST['order_id'])) {
    $cart_id = $_POST['cart_id'];
    $order_id = $_POST['order_id'];

    // Perform the delete query to delete the cart item
    $delete_query = "DELETE FROM cart WHERE id = '$cart_id'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        // Fetch existing cart IDs from the orders table
        $fetch_cart_ids_query = "SELECT cart_ids FROM orders WHERE id = '$order_id'";
        $fetch_cart_ids_result = mysqli_query($conn, $fetch_cart_ids_query);
        $fetch_cart_ids_row = mysqli_fetch_assoc($fetch_cart_ids_result);
        $cart_ids = explode(',', $fetch_cart_ids_row['cart_ids']);

        // Remove the deleted cart ID from the array
        $updated_cart_ids = array_diff($cart_ids, array($cart_id));

        // Update the cart_ids column in the orders table
        $updated_cart_ids_string = implode(',', $updated_cart_ids);
        $update_cart_ids_query = "UPDATE orders SET cart_ids = '$updated_cart_ids_string' WHERE id = '$order_id'";
        $update_cart_ids_result = mysqli_query($conn, $update_cart_ids_query);

        if ($update_cart_ids_result) {
            // Recalculate total price after updating cart_ids
            $total_price_query = "SELECT SUM(p.p_price * c.qty) AS total_price FROM product p JOIN cart c ON p.id = c.product_id WHERE c.id IN ('$updated_cart_ids_string')";
            $total_price_result = mysqli_query($conn, $total_price_query);
            $total_price_row = mysqli_fetch_assoc($total_price_result);
            $total_price = $total_price_row['total_price'];

            // Update the total_amount in the orders table
            $update_total_amount_query = "UPDATE orders SET total_amount = '$total_price' WHERE id = '$order_id'";
            $update_total_amount_result = mysqli_query($conn, $update_total_amount_query);

            if ($update_total_amount_result) {
                // Redirect back to the page with success message
                header("Location: ../index.php?success=Cart item deleted successfully");
                exit();
            } else {
                // Redirect back to the page with error message
                header("Location: ../index.php?error=Failed to update total amount");
                exit();
            }
        } else {
            // Redirect back to the page with error message
            header("Location: ../index.php?error=Failed to update order");
            exit();
        }
    } else {
        // Redirect back to the page with error message
        header("Location: ../index.php?error=Failed to delete cart item");
        exit();
    }
}else {
    // Redirect back to the page with error message
    header("Location: ../index.php?error=Invalid request");
    exit();
}
?>
