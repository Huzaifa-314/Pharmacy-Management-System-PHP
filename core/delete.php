<?php
include '../include/connection.php';
session_start();

// Initialize message variables
$error = "";
$success = "";

// Check if delete_cart_id is present in the GET parameters
if(isset($_GET['delete_cart_id'])) {
    // Get the delete_cart_id from the GET parameters
    $delete_cart_id = $_GET['delete_cart_id'];
    
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];
    
    // Delete the item from the cart table
    $sql_delete = "DELETE FROM cart WHERE id = '$delete_cart_id' AND user_id = '$user_id'";
    if(mysqli_query($conn, $sql_delete)) {
        $success = "Record deleted successfully from cart.";
    } else {
        $error = "Error: " . $sql_delete . "<br>" . mysqli_error($conn);
    }
    
    // Build the URL parameters based on the messages
    $urlParams = "";
    if(!empty($error)) {
        $urlParams .= "error=" . urlencode($error);
    }
    if(!empty($success)) {
        $urlParams .= "&success=" . urlencode($success);
    }
    
    // Redirect back to the cart page after deleting the item
    header("Location: ../cart.php" . ($urlParams ? "?" . $urlParams : ""));
    exit;
}
?>
