<?php include 'include/header.php'; 

?>


<section class="S-catagory">
  <div class="category container-fluid">
    <div class="container">
      <h1 class="catagory-title" style="margin-top:30px;">Shop By Category</h1>
      <hr>
    </div>
  </div>
  <div class="product">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <img src="images/medicine.png" width=150>
          <h4>Prescription Medicine</h4>
        </div>
        <div class="col-md-3">
          <img src="images/device.png" width=150>
          <h4>Medical Devices</h4>
        </div>
        <div class="col-md-3">
          <img src="images/baby.png" width=150>
          <h4 style="margin-top: 10px;">Baby & Mom</h4>
        </div>
        <div class="col-md-3">
          <img src="images/skin.png" width=150>
          <h4>Skin Care</h4>
        </div>

      </div>

    </div>

  </div>
</section>
<!-- category 1 -->
<section class="c-1">
  <div class="container-fluid mt-5">
    <div class="container">
      <h1 class="catagory-title">Prescribed Medicine</h1>
    </div>

  </div>
  <div class="product">
    <div class="container">
      <div class="row">

          <?php
          $sql = "SELECT stock.*,product.* FROM `stock` join product on stock.product_id=product.id where main_category_id = 1 and qty <> 0  order by stock.id desc limit 8";
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
                              <div class="product-price"><?php echo $row['unit_price']; ?>৳</div>
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
</section>

<!-- category 2 -->
<section class="c-2">
  <div class="container-fluid">
    <div class="container">
      <h1 class="catagory-title">Medical Devices</h1>
    </div>

  </div>
  <div class="product">
    <div class="container">
      <div class="row">

          <?php
          $sql = "SELECT stock.*,product.* FROM `stock` join product on stock.product_id=product.id where main_category_id = 2 and qty <> 0  order by stock.id desc limit 8";
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
                              <div class="product-price"><?php echo $row['unit_price']; ?>৳</div>
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
</section>

<!-- category 3  -->
<section class="c-2">
  <div class="container-fluid">
    <div class="container">
      <h1 class="catagory-title">Skin care</h1>
    </div>

  </div>
  <div class="product">
    <div class="container">
      <div class="row">

          <?php
          $sql = "SELECT stock.*,product.* FROM `stock` join product on stock.product_id=product.id where main_category_id = 3 and qty <> 0  order by stock.id desc limit 8";
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
                              <div class="product-price"><?php echo $row['unit_price']; ?>৳</div>
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
</section>







<?php include 'include/footer.php'; ?>