
    <?php include 'include/header.php'; 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM product WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $brand = $row['brand'];
        $generic = $row['generic'];
        $image = $row['image'];
        $description = $row['description'];
        $stock = $row['qty'];
        $manufacturer = $row['manufacturer'];
        $main_category_id = $row['main_category_id'];
        $p_price = $row['p_price'];

        // Initialize variables
        $first_description = $description; // Assign entire description to first part
        $second_description = ""; // Initialize second part as empty string

        // Check if the description length is greater than 300 characters
        if(strlen($description) > 300) {
            // Divide the description string into two parts
            $first_description = substr($description, 0, 600); // Extract first 300 characters
            $second_description = substr($description, 600); // Extract the rest of the string
        }
    }
    ?>

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Catagory</li>
        </ol>
    </nav>

    <div class="cat-single-product">
        <div class="container">
            <div class="row">
                <div class="cat-single-product-image col-sm-6 col-md-4">
                    <img src="images/product/<?php echo $image?>" alt="">
                </div>
                <div class="col-sm-6 col-md-4 d-flex align-items-center">
                    <div class="cat-single-product-info">
                        <h4 class="title"><strong><?php echo $brand; ?></strong></h4><br>
                        <strong class="generic">Generic Name: </strong><span><?php echo $generic; ?></span><br>
                        <strong class="manufacturer">Manufacturer: </strong><span><?php echo $manufacturer; ?></span><br>
                        <!-- <strong class="type">Type: </strong><span>Tablet</span><br> -->
                        <!-- <strong class="size">Pack Size: </strong><span>510 pcs</span><br> -->

                    </div>
                </div>

                <div class="col-sm d-flex align-items-center">
                    <div class="cat-single-product-price">
                        <h2 class="price"><strong>৳<?php echo $p_price ?></strong></h2>
                        <p>Inclusive of all taxes</p>
                        <form class="inc-dec" action='cart.php' method="get">
                           <script>
                                // JavaScript code
                                function increment() {
                                    var input = document.getElementById("qty_value");
                                    var value = parseInt(input.value);
                                    input.value = value + 1;
                                }

                                function decrement() {
                                    var input = document.getElementById("qty_value");
                                    var value = parseInt(input.value);
                                    if (value > 0) {
                                        input.value = value - 1;
                                    }
                                }

                            </script>
                            <div>
                                <!-- Increment button -->
                                <button type="button" class="inc-dec-button" onclick="decrement()">-</button>
                                <input name="qty" style="text-align:center; width:50px" type="number" id="qty_value" value=1 min=1 max=20>
                                <!-- Decrement button -->
                                <button type="button" class="inc-dec-button"  onclick="increment()">+</button>
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                            </div>
                            <div style="margin-top:10px">
                              <button><i class="fa fa-shopping-cart"> Add to Cart</i></button>
                            </div>
                        </form>
                        <p style="margin-top:50px">To buy <?php echo $brand." ".$generic ?>, Click/Tap 'ADD TO CART' Now.</p>
                    </div>
                </div>
            </div>




            <div class="row mt-5 detailed-description">
                <div class="col-12 mb-2">
                    <h3>Information about <?php echo $brand." ".$generic ?></h3>

                </div>
                <div class="col-md-6">
                    <?php echo $first_description; ?>
                </div>
                <div class="col-md-6">
                    <?php echo $second_description; ?>
                </div>

            </div>
        </div>
    </div>

    <div class="cat-related-product mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <h3>Related Products</h3>
                </div>

                <?php
                    $sql = "SELECT * FROM product where main_category_id = 1 and id<> '$id' order by id desc limit 4";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="single-product">
                                <a href="product.php?id=<?php echo $row['id']; ?>">
                                    <div class="product-image"><img src="images/product/<?php echo $row['image']; ?>" alt=""></div>
                                </a>
                                <div class="product-card-body">
                                    <div class="product-heading">
                                        <div class="product-name">
                                            <a href="product.php?id=<?php echo $row['id']; ?>">
                                                <p class="com-name"><?php echo $row['brand']; ?></p>
                                                <p class="generic-name"><?php echo $row['generic']; ?></p>
                                            </a>
                                        </div>
                                        <div class="product-price"><?php echo $row['p_price']; ?>৳</div>
                                    </div>
                                    <a href="cart.php?product_id=<?php echo $row['id']; ?>"><div class="add-to-cart"><button> <span>Add to Cart</span></button></div></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>

            </div>
        </div>
    </div>




    <?php include 'include/footer.php'; ?>
