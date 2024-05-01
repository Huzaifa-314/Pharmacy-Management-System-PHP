<?php
include 'include/header.php';
if(!isLoggedIn()) {
    header("Location: signinup.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user information from the database
$sql_user = "SELECT * FROM user WHERE id = $user_id";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);

// Initialize variables for user information
$name = $row_user['u_name'];
$address = $row_user['address'];
$phone = $row_user['phone'];

// Calculate total amount of order
$total_amount = 0;
$sql_cart = "SELECT p.p_price, c.qty FROM product p JOIN cart c ON p.id = c.product_id WHERE c.user_id = $user_id and c.status = 0";
$result_cart = mysqli_query($conn, $sql_cart);
while ($row_cart = mysqli_fetch_assoc($result_cart)) {
    $total_amount += $row_cart['p_price'] * $row_cart['qty'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['action']) && $_POST['action'] == "place_order") {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $user_id = $_SESSION['user_id']; // Get user ID from session
        $cart_ids = [];
        $sql = "SELECT * FROM cart WHERE user_id = $user_id and status = 0";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $cart_id = $row['id'];
            //insert $cart_id to $cart_ids
            $cart_ids[] = $cart_id;
        }
        // Update cart status to 1
        $sql = "UPDATE cart SET status = 1 WHERE user_id = $user_id and status = 0";
        $result = mysqli_query($conn, $sql);
        // Insert order into database
        $cart_ids_str = implode(',', $cart_ids); // Convert array to comma-separated string
        $sql = "INSERT INTO orders (user_id, name, address, phone, cart_ids, total_amount, payment_method, status, date) VALUES ($user_id, '$name', '$address', '$phone', '$cart_ids_str', $total_amount, '0', 0, NOW())";
        $result = mysqli_query($conn, $sql);
        // Redirect to order confirmation page
        header("Location: order_confirmation.php");
        exit;
    }
}
?>

<form action="checkout.php" method="post">
    <section class="c-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Billing Information</h2>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Payment Method:</label>
                            <input type="text" class="form-control" id="payment_method" name="payment_method" value="Cash on Delivery" readonly>
                        </div>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <h2>Order Summary</h2>
                    <div>
                        <div>
                            Total Amount:
                            <div class="product-price"><?php echo $total_amount; ?>৳</div>
                            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                            <input type="hidden" name="action" value="place_order">
                        </div>
                        <!-- Display order summary or any other relevant information here -->
                        <button type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php include 'include/footer.php';?>
