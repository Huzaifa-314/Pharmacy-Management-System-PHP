<?php include 'include/header.php'; 
    if(!isLoggedIn()) {
        header("Location: signinup.php");
        exit;
    }

    $searched_string = $_POST['search_medicine'];
?>
<!-- category 1 -->
<section class="c-1">
  <div class="container-fluid mt-5">
    <div class="container">
      <h1 class="catagory-title">Searched Results</h1>
    </div>

  </div>
  <div class="product">
    <div class="container">
      <div class="row">

        <?php
          //where name of brand like serched string
          $sql = "SELECT * FROM product where brand like '%$searched_string%' or generic like '%$searched_string%'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0) {
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
        }else{
            ?>  
                    <div class="text-center">
                    <h2>No Result Found</h2>
                </div>

            
            <?php
        }
        ?>



      </div>

    </div>

  </div>
</section>







<?php include 'include/footer.php'; ?>