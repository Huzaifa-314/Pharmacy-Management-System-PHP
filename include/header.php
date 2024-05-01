<?php
ob_start();
session_start();
include 'include/connection.php';
include 'include/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Shop</title>
    <!-- style sheet -->
    <link rel="stylesheet" href="style.css">

    <!-- font awesome 4 link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- javascript -->
    <script src="main.js"></script>
</head>

<body>
    <!-- Header serction start -->
    <!-- --------------------- -->
    <header>

        <!-- top header -->
        <div class="top-header bg-light">
            <div class="container-fluid">
                <div class="top-header-items">
                    <div class="pharmacy-info">
                        <div class="email d-none d-sm-block">
                            <i class="fa fa-envelope"></i>
                            <span>mdtanvirbd.14@gmail.com</span>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"></i>
                            <span>01595-525676</span>
                        </div>
                        <div class="address d-none d-md-block">
                            <i class="fa fa-map-marker"></i>
                            <span>Uttara sector 10, road 13</span>
                        </div>
                    </div>
                    <div class="social d-none d-md-block">
                        <a href="https://www.facebook.com/hmodelpharmacy"><i class="fa fa-facebook-square fa-2x" style="color:#3b5998;"></i></a>
                        <!--<a href="#"><i class="fa fa-whatsapp fa-2x" style="color:#075E54;"></i></a>-->
                    </div>
                </div>
            </div>
        </div>


        <!-- middle header -->
        <div class="middle-header">
            <div class="container-fluid">
                <div class="middle-header-items d-flex align-items-center justify-content-between">
                    <a href="index.php">
                        <div class="logo"><img src="img/logo.png" alt=""></div>
                    </a>

                    <!-- search -->
                    <form class="search d-none d-md-block" method="post" action="search.php">
                        <input type="text" name="search_medicine" class="header-search-input" placeholder="Search Medicine" required>
                        <button style="margin-left:-19px" type="submit" class="header-search-button" value="Submit"><i class="fa fa-search"></i></button>
                    </form>


                    <div class="right navbar navbar-expand-md">
                        <ul class="d-flex align-items-center">
                            <?php 
                                if(isLoggedIn()) {
                                    ?>
                                        <!-- cart start -->
                                        <li id="open-cart"><a href="cart.php" class="cart">
                                            <i class="fa fa-shopping-cart fa-lg"> Cart</i>
                                            <div class="cart-counter text-center text-white">
                                                <?php
                                                    //count total items in cart form database
                                                    $user_id = $_SESSION['user_id'];
                                                    $total_items = 0;
                                                    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' and status = 0";
                                                    $result = mysqli_query($conn, $sql);
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                        $total_items += $row['qty'];
                                                    }
                                                    echo $total_items;
                                                ?>
                                            </div>
                                        </a></li>
                                        <!-- cart end -->
                                    <?php 
                                }
                            ?>

                            <!-- <li>
                                <a href="user.php" class="sign-in">
                                    <i class="fa fa-user fa-2x"></i>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- bottom header -->
        <nav class="bottom-header navbar navbar-expand-md navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="search-extra d-block d-md-none d-flex justify-content-center">
                <input type="text" class="header-search-extra-input" placeholder="Search Medicine">
                <button type="submit" class="header-search-extra-button" value="Submit"><i class="fa fa-search"></i></button>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="location.php">Location</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Catagory
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- fetch all the main category from database -->
                            <?php
                            $sql = "SELECT * FROM main_category";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $name = $row['name'];
                                ?><a class='dropdown-item' href='catagory_template.php?id=<?php echo $id; ?>'><?php echo $name; ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php
                            }
                            ?>
                            
                            <!-- <a class="dropdown-item" href="catagory_template.php">Prescribed Medicine</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="catagory_template.php">OTC</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="catagory_template.php">Health Product</a> -->
                            <!-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a> -->
                        </div>
                    </li>
                    <li class="nav-item">
                        <?php 
                            if(isLoggedIn()) {
                                ?><a class="nav-link" href="include/logout.php">Logout</a><?php
                            } else { 
                                ?><a class="nav-link" href="signinup.php">Sign in/Register</a><?php
                                
                             } ?>
                    </li>
                    <li class="d-block d-md-none"><a href="" class="">
                            <button class="upload-prescription">Prescription</button>
                        </a></li>

                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form> -->
            </div>
        </nav>

    </header>
    <!-- Header serction end -->
    <!-- --------------------- -->