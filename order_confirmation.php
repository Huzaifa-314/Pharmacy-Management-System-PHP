<?php
include 'include/header.php'; // Include header file

// Check if user is logged in
if(!isLoggedIn()) {
    header("Location: signinup.php");
    exit;
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user information from the database
$sql_user = "SELECT * FROM user WHERE id = $user_id";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);

// Fetch order information from the database
$sql_order = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC LIMIT 1"; // Assuming you want the latest order
$result_order = mysqli_query($conn, $sql_order);
$row_order = mysqli_fetch_assoc($result_order);

// Fetch cart IDs from the order
$cart_ids_str = $row_order['cart_ids'];
$cart_ids = explode(',', $cart_ids_str); // Split the string into an array of cart IDs

// Fetch product information for the order
$order_products = [];
foreach ($cart_ids as $cart_id) {
    $sql_product = "SELECT p.*, c.qty FROM product p JOIN cart c ON p.id = c.product_id WHERE c.id = $cart_id AND c.status = 1";
    $result_product = mysqli_query($conn, $sql_product);
    $row_product = mysqli_fetch_assoc($result_product);
    if ($row_product) {
        $order_products[] = $row_product;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Order Summary</h1>
        
        <div class="row mt-5">
            <div class="col-md-6">
                <h2>User Information:</h2>
                <p><strong>Name:</strong> <?php echo $row_order['name']; ?></p>
                <p><strong>Address:</strong> <?php echo $row_order['address']; ?></p>
                <p><strong>Phone:</strong> <?php echo $row_order['phone']; ?></p>
            </div>
            <div class="col-md-6">
                <h2>Order Details:</h2>
                <div>
                    Total Amount:
                    <div class="product-price"><?php echo $row_order['total_amount']; ?>৳</div> 
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col">
                <h3>Ordered Products:</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 1;
                        foreach ($order_products as $row_product) { ?>
                            <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="product.php?id=<?php echo $row_product['id'];?>"><img src="images/product/<?php echo $row_product['image']; ?>" width="50" class="mr-2"></a>
                                        <div>
                                            <a href="product.php?id=<?php echo $row_product['id'];?>"><div><?php echo $row_product['brand']; ?></div></a>
                                            <div><?php echo $row_product['generic']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $row_product['qty']; ?></td>
                            </tr>
                            <?php $count++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'include/footer.php';?>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
