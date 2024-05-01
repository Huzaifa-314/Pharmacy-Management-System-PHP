<?php
include '../include/connection.php';
include 'include/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- left panel -->
    <?php include 'include/left-panel.php'; ?>

    <div class="panel-area">

        <!-- top navbar -->
        <?php include 'include/top-nav.php'; ?>


        <div class="main-area">
            <div id="add-product" class="tab-content">
                <?php if(isset($_GET["error"])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php print_r($_GET["error"]);?>
                        </div>
                    <?php endif; ?>

                    <!-- print success message -->
                    <?php if(isset($_GET["success"])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php print_r($_GET["success"]);?>
                        </div>
                    <?php endif; ?>

                <div class="add-product p-1 box">
                    <h5 class="box-title">Add Product</h5>
                    <div class="dropdown-divider"></div>
                    <form action="core/insert.php" method="post" enctype="multipart/form-data" >
                        <input type= "hidden" name= "type" value="add-product">
                        <div class="row">
                            <div class="left">
                                <div class="input-field box-content">
                                    <div class="input-item">
                                        <div>Brand Name:</div>
                                        <input name="brand_name" type="text">
                                    </div>
                                    <div class="input-item">
                                        <div>Generic Name:</div>
                                        <input name="generic_name" type="text">
                                    </div>
                                    <div class="input-item">
                                        <div>Type:</div>
                                        <style>
                                            select {
                                                height: 30px;
                                                border:none;
                                                outline:none;
                                                border-radius: 3px;
                                            }
                                        </style>
                                        <select name="main_category">
                                        <?php
                                            $main_category_query_result = mysqli_query($conn, "SELECT * FROM main_category");
                                            while ($category_row = mysqli_fetch_assoc($main_category_query_result)) {
                                                ?>
                                                    <option value="<?php echo $category_row['id'];?>"><?php echo $category_row['name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="input-item">
                                        <div>Manufacturer:</div>
                                        <input name="manufacturer" type="text">
                                    </div><br>
                                    <style>
                                        .input-item textarea {
                                            width:650px;
                                            height: 100px;
                                            resize: both;
                                            border:none;
                                            border-radius: 3px;
                                        }
                                    </style>
                                    <div class="input-item">
                                        <div>Big description:</div>
                                        <textarea name="description" type="text"></textarea>
                                    </div><br>
                                    <div class="input-item">
                                        <div>Retail Price:</div>
                                        <input name="price" type="number">
                                    </div>
                                    <div class="input-item">
                                        <div>Product picture:</div>
                                        <input name="image" type="file">
                                    </div>
                                    <button type="submit" class="">Add</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="product-table p-1 box">

                    <h5 class="box-title">All Products</h5>
                    <div class="dropdown-divider"></div>
                    <div class="tbl-scroll">
                    <table class="table box-content">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Generic</th>
                                <th scope="col">Main category</th>
                                <th scope="col">Manufacturer</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT * FROM product ORDER BY main_category_id, id DESC";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                    <?php
                                        $main_category_query_result = mysqli_query($conn, "SELECT * FROM main_category WHERE id = ".$row['main_category_id']);
                                        $main_category_row = mysqli_fetch_assoc($main_category_query_result);
                                    ?>

                                        <td scope="row"><?php echo $counter; ?></td>
                                        <td class="brand"><?php echo $row['brand']; ?></td>
                                        <td class="generic"><?php echo $row['generic']; ?></td>
                                        <td class="generic"><?php print_r($main_category_row['name']); ?></td>
                                        <td class="manufacturer"><?php echo $row['manufacturer']; ?></td>
                                        <td class="price"><?php echo $row['p_price']; ?>৳</td>
                                        <td class="status"><?php echo $row['status']; ?></td>
                                    </tr>
                                    <?php
                                    $counter++;
                                }
                            } else {
                                echo "No products found.";
                            }
                            ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
            <div id="sale-product" class="tab-content">
                <?php if(isset($_GET["error"])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php print_r($_GET["error"]);?>
                        </div>
                    <?php endif; ?>

                    <!-- print success message -->
                    <?php if(isset($_GET["success"])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php print_r($_GET["success"]);?>
                        </div>
                    <?php endif; ?>
                <div class="p-1 box">
                    <h5 class="box-title">Sale Product</h5>
                    <div class="dropdown-divider"></div>
                    <form action="core/insert.php" method="post" enctype="multipart/form-data" name="sale-product">
                        <input type="hidden" name="type" value="sale-product">
                        <div class="row">
                            <div class="left">
                                <div class="input-field box-content">
                                    <div class="input-item">
                                        <div>Medicine Name:</div>
                                        <select name="medicine_id" class="select2" id="select_medicine" onchange="getRetailPrice()">
                                            <option value="" selected disabled>Select Medicine</option>
                                            <?php
                                            $product_query = "SELECT * FROM product";
                                            $product_result = mysqli_query($conn, $product_query);
                                            while($product_row = mysqli_fetch_assoc($product_result)){
                                                echo "<option value='".$product_row['id']."'>".$product_row['brand']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-item">
                                        <div>Retail Price:</div>
                                        <input name="price" type="number" step="0.01" id="retail_price" readonly>
                                    </div>
                                    <div class="input-item">
                                        <div>Quantity (pieces):</div>
                                        <input name="qty" type="number" step="1" oninput="calculateTotal()">
                                    </div>
                                    <div class="input-item">
                                        <div>Discount(%):</div>
                                        <input name="discount" type="number" step="0.01" oninput="calculateTotal()" value="0">
                                    </div>
                                    <div class="input-item">
                                        <div>Total Price:</div>
                                        <input type="number" step="0.01" name="total_price" readonly>
                                    </div>
                                    <button type="submit" class="">Sale</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                    function getRetailPrice() {
                        var productId = document.getElementById("select_medicine").value;
                        console.log(productId);
                        var retailPriceField = document.getElementById("retail_price");

                        // Send AJAX request to fetch the retail price based on the selected product ID
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "core/ajax.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                retailPriceField.value = xhr.responseText;
                                calculateTotal(); // Calculate total price after updating retail price
                            }
                        };
                        xhr.send("product_id=" + productId);
                    }

                    function calculateTotal() {
                        var price = parseFloat(document.forms["sale-product"]["price"].value);
                        var qty = parseFloat(document.forms["sale-product"]["qty"].value);
                        var discount = parseFloat(document.forms["sale-product"]["discount"].value);
                        var discounted = price * qty * (1 - discount / 100);
                        var totalPriceInput = document.forms["sale-product"]["total_price"];
                        
                        // Check if the calculation is valid (all input fields have valid numeric values)
                        if (!isNaN(discounted)) {
                            totalPriceInput.value = discounted.toFixed(2); // Set the total price with 2 decimal places
                        } else {
                            totalPriceInput.value = ''; // Clear the total price if calculation is invalid
                        }
                    }
                    </script>

                </div>
                <div class="product-table p-1 box">

                    <h5 class="box-title">Offline Sale History</h5>
                    <div class="dropdown-divider"></div>
                    <div class="tbl-scroll">
                    <table class="table box-content">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch data from the sale table
                            $data_query = "SELECT * FROM sale";
                            $data_result = mysqli_query($conn, $data_query);
                            $sl = 1; // Initialize SL counter
                            while ($data_row = mysqli_fetch_assoc($data_result)) {
                                $product_id = $data_row['product_id'];
                                $product_query = "SELECT * FROM product WHERE id = '$product_id'";
                                $product_result = mysqli_query($conn, $product_query);
                                $product_row = mysqli_fetch_assoc($product_result);
                                $product_name = $product_row['brand'];
                                echo "<tr>";
                                echo "<th scope='row'>" . $sl++ . "</th>"; // Increment SL counter
                                echo "<td>" . $product_name . "</td>";
                                echo "<td>" . $data_row['qty'] . "</td>";
                                echo "<td>" . $data_row['p_price'] . "</td>";
                                echo "<td>" . $data_row['discount'] . "</td>";
                                echo "<td>" . $data_row['t_price'] . "</td>";
                                echo "<td>" . $data_row['date'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>


                    </div>
                </div>
            </div>
            <div id="online-sale-product" class="tab-content">
                <?php if(isset($_GET["error"])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php print_r($_GET["error"]);?>
                    </div>
                <?php endif; ?>

                <!-- print success message -->
                <?php if(isset($_GET["success"])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php print_r($_GET["success"]);?>
                    </div>
                <?php endif; ?>

                <div class="product-table p-1 box">
                    <h5 class="box-title">Online Sale History</h5>
                    <div class="dropdown-divider"></div>
                    <div class="tbl-scroll">
                        <table class="table box-content">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">User Who Ordered</th>
                                    <th scope="col">Given Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Cart</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch data from the orders table
                                $data_query = "SELECT * FROM orders";
                                $data_result = mysqli_query($conn, $data_query);
                                $sl = 1; // Initialize SL counter
                                while ($data_row = mysqli_fetch_assoc($data_result)) {
                                    // Fetch user name from user table
                                    $user_id = $data_row['user_id'];
                                    $user_query = "SELECT u_name FROM user WHERE id = '$user_id'";
                                    $user_result = mysqli_query($conn, $user_query);
                                    $user_row = mysqli_fetch_assoc($user_result);
                                    $user_name = $user_row['u_name'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sl++; ?></td> <!-- Increment SL counter -->
                                        <td><?php echo $user_name; ?></td>
                                        <td><?php echo $data_row['name']; ?></td>
                                        <td><?php echo $data_row['address']; ?></td>
                                        <td><?php echo $data_row['phone']; ?></td>
                                        <td>
                                            <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#showCartModal<?php echo $data_row['id']; ?>'>Show</a>
                                        </td>
                                        <td><?php echo $data_row['total_amount']; ?></td>
                                        <td>
                                            <?php if($data_row['status'] == 0): ?>
                                                <span class='badge badge-warning'>Pending</span>
                                            <?php else: ?>
                                                <span class='badge badge-success'>Delivered</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $data_row['date']; ?></td>
                                        <td>
                                            <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#editOrderModal<?php echo $data_row['id']; ?>'><i class='fas fa-edit'></i></a>
                                            <a href='core/delete.php?type=delete&id=<?php echo $data_row['id']; ?>' class='badge badge-danger'><i class='fas fa-trash-alt'></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Show Cart Modal -->
                <?php
                $data_result = mysqli_query($conn, $data_query); // Reset data result pointer
                while ($data_row = mysqli_fetch_assoc($data_result)) {
                ?>
                <div class='modal fade' id='showCartModal<?php echo $data_row['id']; ?>' tabindex='-1' role='dialog' aria-labelledby='showCartModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='showCartModalLabel'>Cart Items</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Actions</th> <!-- Added actions column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch cart items from cart IDs
                                        $cart_ids = explode(',', $data_row['cart_ids']);
                                        $total_price = 0;
                                        $count = 1;
                                        foreach ($cart_ids as $cart_id) {
                                            // Fetch cart item details from the database based on cart ID
                                            $cart_query = "SELECT p.*, c.qty FROM product p JOIN cart c ON p.id = c.product_id WHERE c.id = $cart_id";
                                            $cart_result = mysqli_query($conn, $cart_query);
                                            $cart_row = mysqli_fetch_assoc($cart_result);
                                            $product_total_price = $cart_row['p_price'] * $cart_row['qty'];
                                            $total_price += $product_total_price;
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $count; ?></th>
                                                <td><?php echo $cart_row['brand']; ?></td>
                                                <td><?php echo $cart_row['qty']; ?></td>
                                                <td><?php echo $product_total_price; ?></td>
                                                <td> <!-- Added actions column -->
                                                    <!-- Edit icon badge -->
                                                    <a href="#" class="badge badge-primary" data-toggle="modal" data-target="#editCartItemModal<?php echo $cart_id; ?>"><i class="fas fa-edit"></i></a>
                                                    <!-- Delete icon badge -->
                                                    <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteCartItemModal<?php echo $cart_id; ?>"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Delete Cart Item Modal -->
                                            <div class='modal fade' id='deleteCartItemModal<?php echo $cart_id; ?>' tabindex='-1' role='dialog' aria-labelledby='deleteCartItemModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog modal-sm' role='document'> <!-- Smaller modal size -->
                                                    <div class='modal-content' style='background-color: #f0f0f0;'> <!-- Custom background color -->
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='deleteCartItemModalLabel'>Delete Cart Item</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <!-- Delete form inside modal -->
                                                            <form method='POST' action='core/delete.php'>
                                                                <input type='hidden' name='type' value='delete_cart'>
                                                                <input type='hidden' name='cart_id' value='<?php echo $cart_id; ?>'>
                                                                <input type='hidden' name='order_id' value='<?php echo $data_row['id']; ?>'>
                                                                <p>Are you sure you want to delete this item?</p>
                                                                <button type='submit' class='btn btn-danger'>Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Cart Item Modal -->
                                            <div class='modal fade' id='editCartItemModal<?php echo $cart_id; ?>' tabindex='-1' role='dialog' aria-labelledby='editCartItemModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog modal-sm' role='document'> <!-- Smaller modal size -->
                                                    <div class='modal-content' style='background-color: #f0f0f0;'> <!-- Custom background color -->
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='editCartItemModalLabel'>Edit Cart Item Quantity</h5>
                                                            <!-- <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button> -->
                                                        </div>
                                                        <div class='modal-body'>
                                                            <!-- Edit form inside modal -->
                                                            <form method='POST' action='core/update.php'>
                                                                <input type='hidden' name='type' value='edit_cart'>
                                                                <input type='hidden' name='cart_id' value='<?php echo $cart_id; ?>'>
                                                                <input type='hidden' name='order_id' value='<?php echo $data_row['id']; ?>'>
                                                                <div class='form-group'>
                                                                    <label for='new_qty'>New Quantity</label>
                                                                    <input type='number' class='form-control' min=0 id='new_qty' name='new_qty' value='<?php echo $cart_row['qty']; ?>' required>
                                                                </div>
                                                                <button type='submit' class='btn btn-primary'>Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div>Total Price: <?php echo $total_price; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Order Modal -->
                <div class='modal fade' id='editOrderModal<?php echo $data_row['id']; ?>' tabindex='-1' role='dialog' aria-labelledby='editOrderModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='editOrderModalLabel'>Edit Order</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form method='POST' action='core/update.php'>
                                    <input type='hidden' name='type' value='edit_order'>
                                    <input type='hidden' name='order_id' value='<?php echo $data_row['id']; ?>'>

                                    <div class='form-group'>
                                        <label for='name'>Name</label>
                                        <input type='text' class='form-control' id='name' name='name' value='<?php echo $data_row['name']; ?>'>
                                    </div>

                                    <div class='form-group'>
                                        <label for='address'>Address</label>
                                        <input type='text' class='form-control' id='address' name='address' value='<?php echo $data_row['address']; ?>'>
                                    </div>

                                    <div class='form-group'>
                                        <label for='phone'>Phone</label>
                                        <input type='text' class='form-control' id='phone' name='phone' value='<?php echo $data_row['phone']; ?>'>
                                    </div>

                                    <div class='form-group'>
                                        <label for='status'>Status</label>
                                        <select class='form-control' id='status' name='status'>
                                            <option value='0' <?php if($data_row['status'] == 0) echo 'selected'; ?>>Pending</option>
                                            <option value='1' <?php if($data_row['status'] == 1) echo 'selected'; ?>>Delivered</option>
                                        </select>
                                    </div>

                                    <button type='submit' class='btn btn-primary'>Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div id="stock" class="tab-content">
                <?php if(isset($_GET["error"])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php print_r($_GET["error"]);?>
                    </div>
                <?php endif; ?>

                <!-- print success message -->
                <?php if(isset($_GET["success"])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php print_r($_GET["success"]);?>
                    </div>
                <?php endif; ?>
                <div class="p-1 box">
                    <h5 class="box-title">Purchase Product</h5>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="left">
                            <form action="core/insert.php" method="post" enctype="multipart/form-data" class="input-field box-content">
                                <input type="hidden" name="type" value="purchase-product">
                                <div class="input-item">
                                    <div>Medicine Name:</div>
                                    <select name="medicine_id" class="select2" id="select_medicine" onchange="getRetailPrice()">
                                        <option value="" selected disabled>Select Medicine</option>
                                        <?php
                                        $product_query = "SELECT * FROM product";
                                        $product_result = mysqli_query($conn, $product_query);
                                        while($product_row = mysqli_fetch_assoc($product_result)){
                                            echo "<option value='".$product_row['id']."'>".$product_row['brand']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-item">
                                    <div>vendor name:</div>
                                    <input name="vendor" type="text">
                                </div>
                                <div class="input-item">
                                    <div>Quantity(pice):</div>
                                    <input name="qty" type="number">
                                </div>
                                <div class="input-item">
                                    <div>Production Date:</div>
                                    <input name="production_date" type="date">
                                </div>
                                <div class="input-item">
                                    <div>Expiry Date:</div>
                                    <input name="expiry_date" type="date">
                                </div>
                                <div class="input-item">
                                    <div>Unit Price:</div>
                                    <input name="unit_price" type="number">
                                </div>
                                <div class="input-item">
                                    <div>Purchase Date:</div>
                                    <input name="purchase_date" type="date">
                                </div>
                                <button type="submit" class="">Purchase</button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="product-table p-1 box">

                    <h5 class="box-title">Purchase History</h5>
                    <div class="dropdown-divider"></div>
                    <div class="tbl-scroll">
                    <?php
                        // Fetch data from the database
                        $sql = "SELECT * FROM stock";
                        $result = mysqli_query($conn, $sql);
                        ?>

                        <table class="table box-content">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Vendor</th>
                                    <th scope="col">Quantity(pieces)</th>
                                    <th scope="col">Production Date</th>
                                    <th scope="col">Expiry Date</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Purchase Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //fetch product name
                                    $product_id = $row['product_id'];
                                    $product_query = "SELECT * FROM product WHERE id = '$product_id'";
                                    $product_result = mysqli_query($conn, $product_query);
                                    $product_row = mysqli_fetch_assoc($product_result);
                                    $product_name = $product_row['brand'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $sl; ?></th>
                                        <td class="product-id"><?php echo $product_name ?></td>
                                        <td class="vendor"><?php echo $row['vendor']; ?></td>
                                        <td class="quantity"><?php echo $row['qty']; ?></td>
                                        <td class="production-date"><?php echo $row['production_date']; ?></td>
                                        <td class="expiry-date"><?php echo $row['expiry_date']; ?></td>
                                        <td class="unit-price"><?php echo $row['unit_price']; ?></td>
                                        <td class="total"><?php echo $row['total_price']; ?></td>
                                        <td class="purchase-date"><?php echo $row['purchase_date']; ?></td>
                                    </tr>
                                    <?php
                                    $sl++;
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="reports" class="tab-content">
                <div class="row">
                    <div class="col-md-7">
                        <div class="box">
                        <?php
                        // Include your database connection code here
                        include '../include/connection.php'; 

                        // Fetch most frequently selling products from offline sales (sale table)
                        $query = "
                            SELECT product_id, SUM(qty) AS total_quantity_sold
                            FROM sale
                            GROUP BY product_id
                            ORDER BY total_quantity_sold DESC
                            LIMIT 4;
                        ";
                        $result = mysqli_query($conn, $query);

                        // Check if there are any results
                        if (mysqli_num_rows($result) > 0) {
                        ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="report-status p-3" style="background-image: var(--report-success);">
                                        <div>Frequently Offline Selling</div>
                                        <strong><?php echo mysqli_num_rows($result); ?> Products</strong>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="report-status-body p-2">
                                        <?php
                                        // Loop through the results and display each product
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $product_id = $row['product_id'];
                                            $total_quantity_sold = $row['total_quantity_sold'];
                                            
                                            // Fetch product details from the database based on product_id
                                            $product_query = "SELECT * FROM product WHERE id = '$product_id'";
                                            $product_result = mysqli_query($conn, $product_query);
                                            $product_row = mysqli_fetch_assoc($product_result);
                                            
                                            // Display product details
                                            ?>
                                            <div class="px-2">
                                                <strong><?php echo $product_row['brand']; ?></strong>
                                                <div><?php echo $product_row['generic']; ?></div>
                                                <div><?php echo $total_quantity_sold; ?>tk</div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                            // If no results found
                            echo "No frequently selling products found.";
                        }
                        ?>


                        </div>
                    </div>


                    <?php
                        // Include your database connection code here
                        include '../include/connection.php'; 

                        // Fetch products with quantity less than 50 from the stock table along with details from the product table
                        $query = "
                            SELECT p.brand, p.generic, p.p_price, s.qty
                            FROM stock s
                            JOIN product p ON s.product_id = p.id
                            WHERE s.qty < 50 AND p.main_category_id = 1;
                        ";
                        $result = mysqli_query($conn, $query);

                        // Check if there are any results
                        if (mysqli_num_rows($result) > 0) {
                    ?>
                    <div class="col-md-5">
                        <div class="box">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="report-status p-3" style="background-color: var(--report-danger) !important;">
                                        <div>Expiring</div>
                                        <Strong><?php echo mysqli_num_rows($result); ?> Product</Strong>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="report-status-body p-2">
                                        <?php
                                        // Loop through the results and display each product
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <div class="px-2">
                                                <strong><?php echo $row['brand']; ?></strong>
                                                <div><?php echo $row['generic']; ?></div>
                                                <div>Remaining: <?php echo $row['qty']; ?></div>
                                                <div>Price: <?php echo $row['p_price']; ?>tk</div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        } else {
                            // If no results found
                            echo "No products expiring soon.";
                        }
                    ?>


                <div class="col-md-7">
                    <div class="box">
                        <?php
                        // Include your database connection code here
                        include '../include/connection.php'; 

                        // Fetch most frequently selling products from online sales (orders table)
                        $query = "
                            SELECT product_id, SUM(c.qty) AS total_quantity_sold
                            FROM orders o
                            JOIN cart c ON FIND_IN_SET(c.id, o.cart_ids)
                            WHERE o.status = 'Delivered'
                            GROUP BY product_id
                            ORDER BY total_quantity_sold DESC
                            LIMIT 4;
                        ";
                        $result = mysqli_query($conn, $query);

                        // Check if there are any results
                        if (mysqli_num_rows($result) > 0) {
                        ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="report-status p-3" style="background-image: var(--report-success);">
                                        <div>Frequently Online Selling</div>
                                        <strong><?php echo mysqli_num_rows($result); ?> Products</strong>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="report-status-body p-2">
                                        <?php
                                        // Loop through the results and display each product
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $product_id = $row['product_id'];
                                            $total_quantity_sold = $row['total_quantity_sold'];
                                            
                                            // Fetch product details from the database based on product_id
                                            $product_query = "SELECT * FROM product WHERE id = '$product_id'";
                                            $product_result = mysqli_query($conn, $product_query);
                                            $product_row = mysqli_fetch_assoc($product_result);
                                            
                                            // Display product details
                                            ?>
                                            <div class="px-2">
                                                <strong><?php echo $product_row['brand']; ?></strong>
                                                <div><?php echo $product_row['generic']; ?></div>
                                                <div><?php echo $total_quantity_sold; ?>tk</div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                            // If no results found
                            echo "No frequently selling products found.";
                        }
                        ?>
                    </div>
                </div>



                </div>
                
                <div class="row">
                    <div class="col-md-7">
                        <div class="box">
                            <!-- Hidden elements to store data -->
                            <?php
                            // Include your database connection code here
                            include '../include/connection.php';

                            // Fetch data from the database
                            $query = "SELECT mc.name AS category_name, COUNT(s.product_id) AS total_products
                                    FROM main_category mc
                                    LEFT JOIN product p ON mc.id = p.main_category_id
                                    LEFT JOIN stock s ON p.id = s.product_id
                                    GROUP BY mc.id";
                            $result = mysqli_query($conn, $query);

                            // Counter for unique IDs
                            $counter = 0;

                            // Loop through the result set and create hidden input elements
                            while ($row = mysqli_fetch_assoc($result)) {
                                $categoryName = $row['category_name'];
                                $totalProducts = $row['total_products'];
                            ?>
                                <input type="hidden" id="category_<?php echo $counter; ?>" class="category" data-category="<?php echo $categoryName; ?>" data-total-products="<?php echo $totalProducts; ?>">
                            <?php
                                $counter++;
                            }
                            ?>
                            
                            <!-- Pie chart container -->
                            <div id="piechart" style="height: 300px;"></div>
                        </div>
                    </div>



                    <!-- <div class="col-md-5">
                        <div class="box">
                            <div id="myChart" style="width:100%; height:300px">
                            </div>
                        </div>
                    </div> -->
                </div>

                <!-- <div class="row">
                    <div class="product-table p-1 box">

                        <h5 class="box-title">Products in Stock</h5>
                        <div class="dropdown-divider"></div>
                        <div class="tbl-scroll">
                            <table class="table box-content">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Generic</th>
                                        <th scope="col">Manufacturer</th>
                                        <th scope="col">Strength</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Retail Price</th>
                                        <th scope="col">In stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td class="brand">Nimocon 500</td>
                                        <td class="generic">Azithromycin</td>
                                        <td class="manufacturer">ACI HealthCare Limited</td>
                                        <td class="strength">500 mg</td>
                                        <td class="type">Tablet</td>
                                        <td class="retail-price"></td>
                                        <td class="in-stock">500</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td class="brand">Adbon</td>
                                        <td class="generic">Calcium + Vitamin D3</td>
                                        <td class="manufacturer">ACI HealthCare Limited</td>
                                        <td class="strength">500 mg + 200 IU</td>
                                        <td class="type">Tablet</td>
                                        <td class="retail-price"></td>
                                        <td class="in-stock">220</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td class="brand">Opental 50</td>
                                        <td class="generic">Tramadol Hydrochloride </td>
                                        <td class="manufacturer">ACI HealthCare Limited</td>
                                        <td class="strength">50 mg</td>
                                        <td class="type">Tablet</td>
                                        <td class="retail-price"></td>
                                        <td class="in-stock">320</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
            </div>
            <div id="user-management" class="tab-content">
                <?php if(isset($_GET["error"])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php print_r($_GET["error"]);?>
                        </div>
                    <?php endif; ?>

                    <!-- print success message -->
                    <?php if(isset($_GET["success"])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php print_r($_GET["success"]);?>
                        </div>
                    <?php endif; ?>
                <div class="p-1 box">
                    <h5 class="box-title">Add users</h5>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="left">
                            <div class="input-field box-content">
                                <form method="POST" action="core/insert.php">
                                    <input type="hidden" name="action" value="add_user">
                                    <div class="input-item">
                                        <div>Username:</div>
                                        <input type="text" name="u_name">
                                    </div>
                                    <div class="input-item">
                                        <div>Email:</div>
                                        <input type="email" name="email">
                                    </div>
                                    <div class="input-item">
                                        <div>Password:</div>
                                        <input type="password" name="password">
                                    </div>
                                    <div class="input-item">
                                        <div>Phone:</div>
                                        <input type="text" name="phone">
                                    </div>
                                    <div class="input-item">
                                        <div>Address:</div>
                                        <input type="text" name="address">
                                    </div>
                                    <div class="input-item">
                                        <div>User Role:</div>
                                        <input type="text" name="u_role">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-table p-1 box">
                    <h5 class="box-title">All Users</h5>
                    <div class="dropdown-divider"></div>
                    <div class="tbl-scroll">
                        <table class="table box-content">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Include your database connection code here
                                include '../include/connection.php'; 

                                // Fetch all users from the database
                                $query = "SELECT * FROM user";
                                $result = mysqli_query($conn, $query);

                                // Check if there are any users
                                if (mysqli_num_rows($result) > 0) {
                                    $count = 1;
                                    // Loop through the results and display each user
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $count; ?></th>
                                            <td class="username"><?php echo $row['u_name']; ?></td>
                                            <td class="Email"><?php echo $row['email']; ?></td>
                                            <td class="Phone"><?php echo $row['phone']; ?></td>
                                            <td class="Address"><?php echo $row['address']; ?></td>
                                            <td class="User Role"><?php echo $row['u_role']; ?></td>
                                            <td class="Status"><?php echo $row['status']; ?></td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                } else {
                                    // If no users found
                                    echo "<tr><td colspan='7'>No users found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>




    <!-- chart js -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/3471a30cd8.js" crossorigin="anonymous"></script>

    <!-- bootstrap jquery and js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- custom jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- custom js-->
    <script src="main.js"></script>
</body>

</html>