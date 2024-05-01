
  <!-- header file -->
  <?php include 'include/header.php'; ?>



  <!-- catagory page start -->
  <!-- --------------------- -->

  <!-- breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Catagory</li>
    </ol>
  </nav>

  <?php if(isset($_GET['id'])){
      $category_id=$_GET['id'];
    
  ?>
  <!-- catagory name -->
  <div class="container-fluid">
    <div class="container">
       <h1 class="catagory-title">
        <?php
        $sql = "SELECT * FROM main_category where id = $category_id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['name'];
        }
        ?>
       </h1>
    </div>
   
  </div>

  <div class="product">
    <div class="container">
      <div class="row">
        <?php
          $sql = "SELECT * FROM product where main_category_id = $category_id order by id desc";
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
  <?php } ?>




  <?php include 'include/footer.php'; ?>