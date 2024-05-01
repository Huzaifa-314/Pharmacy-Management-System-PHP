<?php
include 'include/header.php';
if(!isLoggedIn()) {
    header("Location: signinup.php");
    exit;
}

// Check if product_id is present in the GET parameters
if(isset($_GET['product_id'])) {
    // Get the product_id from the GET parameters
    $product_id = $_GET['product_id'];
    
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];
    
    // Check if qty is present in the GET parameters, default to 1 if not present
    $qty = isset($_GET['qty']) ? $_GET['qty'] : 1;
    
    // Check if the product already exists in the cart for the user
    $existing_cart_query = "SELECT * FROM cart WHERE product_id = $product_id AND user_id = $user_id and status = 0";
    $existing_cart_result = mysqli_query($conn, $existing_cart_query);
    if(mysqli_num_rows($existing_cart_result) > 0) {
        // If the product exists, update the quantity
        $existing_cart_row = mysqli_fetch_assoc($existing_cart_result);
        $new_qty = $existing_cart_row['qty'] + $qty; // Update the quantity
        $update_query = "UPDATE cart SET qty = $new_qty WHERE id = {$existing_cart_row['id']}";
        if(mysqli_query($conn, $update_query)) {
            $_GET['success'] = "Quantity updated successfully in cart.";
        } else {
            $_GET['error'] = "Error updating quantity in cart: " . mysqli_error($conn);
        }
    } else {
        // If the product does not exist, insert a new record
        $sql_insert = "INSERT INTO cart (product_id, user_id, qty) VALUES ('$product_id', '$user_id', '$qty')";
        if(mysqli_query($conn, $sql_insert)) {
            $_GET['success'] = "Record added successfully to cart.";
        } else {
            $_GET['error'] = "Error inserting record into cart: " . mysqli_error($conn);
        }
    }
}

?>

<section class="c-1">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div>
                    <!-- Print error message -->
                    <?php if(isset($_GET["error"])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET["error"]; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Print success message -->
                    <?php if(isset($_GET["success"])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET["success"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user_id']; // Get user ID from session
                        $sql = "SELECT * FROM cart WHERE user_id = $user_id and status = 0";
                        $result = mysqli_query($conn, $sql);
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cart_id = $row['id'];
                            $product_id = $row['product_id'];
                            $qty = $row['qty'];
                            // Retrieve product details
                            $product_query = "SELECT * FROM product WHERE id = $product_id";
                            $product_result = mysqli_query($conn, $product_query);
                            $product_row = mysqli_fetch_assoc($product_result);
                            ?>
                            <tr style="background-color: <?php echo $count % 2 == 0 ? '#fff' : '#cfe6f8'; ?>">
                                <th scope="row"><?php echo $count; ?></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="product.php?id=<?php echo $product_id?>"><img src="images/product/<?php echo $product_row['image']; ?>" width="50" class="mr-2"></a>
                                        <div>
                                            <a href="product.php?id=<?php echo $product_id?>"><div><?php echo $product_row['brand']; ?></div></a>
                                            <div><?php echo $product_row['generic']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $product_row['p_price']; ?></td>
                                <td>
                                    <a href="core/delete.php?delete_cart_id=<?php echo $cart_id ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
                <!-- add total amount -->
                <?php
                    $total_amount = 0;
                    $sql_cart = "SELECT p.p_price, c.qty FROM product p JOIN cart c ON p.id = c.product_id WHERE c.user_id = $user_id and c.status = 0";
                    $result_cart = mysqli_query($conn, $sql_cart);
                    while ($row_cart = mysqli_fetch_assoc($result_cart)) {
                        $total_amount += $row_cart['p_price'] * $row_cart['qty'];
                    }

                ?>
                <div class="d-flex justify-content-between">
                    <div>
                        Total Amount:
                        <div class="product-price"><?php echo $total_amount; ?>৳</div> 
                    </div>
                    <div style="margin-bottom:40px" class="text-center">
                        <a href="checkout.php"><button>Checkout</button></a>
                    </div>
                </div>

            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>

<?php include 'include/footer.php';?>
