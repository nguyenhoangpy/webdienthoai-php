<?php
require_once("./DB/DBControler.php");
require_once("./DB/Product.php");
require_once("./DB/AccounControler.php");
require_once("./DB/CartControler.php");
include("./DB/fb-login.php");
include("./DB/gg-login.php");
// session_start();
error_reporting(0);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xác nhận đơn hàng</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link href="/dashboard/images/favicon.png" rel="icon" type="image/png" /> -->
    <!-- <link href="./vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <!-- <link href="./vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="./vnpay_php/assets/jquery-1.11.3.min.js"></script> -->
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=464446248223742&autoLogAppEvents=1" nonce="IBT9SdVt"></script>

</head>

<body>
    <!-- start #header -->
    <header id="header">
        <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
            <p class="font-opensans font-size-12 text-black-50 m-0">Hoàng Nguyễn - Faculty of Information Technology (HUTECH)
                - (034) 44776653</p>
            <div class="font-opensans font-size-14 ">
                <a href="#" class="px-3 border-right border-left text-dark">Tin Tức Công Nghệ</a>
                <?php
                if (!$_SESSION['fullname']) {
                    echo "<a href='login.php' class='px-3 border-right border-left text-dark'>Đăng nhập</a>";
                } else {
                    echo "<a href='#' class='px-3 border-right border-left text-dark'>" . $_SESSION['fullname'] . "</a>";
                    echo "<a href='logout.php' class='px-3 border-right border-left text-dark'>Đăng xuất</a>";
                }
                ?>
                <!-- <a href="#" class="px-3 border-right text-dark">Whishlist (0)</a> -->
            </div>
        </div>

        <!-- Primary Navigation -->
        <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-nav">
            <a class="navbar-brand" href="index.php">24H Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav m-auto font-opensans">
                    <li class="nav-item active">
                        <a class="nav-link" href="list_product_sale.php">Khuyến Mãi</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="list_product.php">Smartphone</a>
                        <!-- </li><li class="nav-item">
            <a class="nav-link" href="/Shop_Mobile_PHP_MySQL/list_product.php">Laptop</a>
          </li> -->
                        <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Danh Mục
            </a>
            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item color-red" href="#">Smartphone</a>
              <a class="dropdown-item color-red" href="#">Laptop</a>
              <a class="dropdown-item color-red" href="#">Phụ kiện</a>
            </div>
          </li> -->
                        <!-- <li class="nav-item">
            <a class="nav-link" href="#">24H Công Nghệ</a>
          </li> -->
                        <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a>
                      </li> -->
                    <li class="nav-item active">
                        <a class="nav-link" href="news.php">Sắp ra mắt</a>
                    </li>
                </ul>
                <form action="#" class="font-size-14 font-opensans">
                    <a href="cart.php" class="py-2 rounded-pill color-red-2-bg">
                        <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                        <span class="px-3 py-2 rounded-pill text-dark bg-light">
                            <?php
                            $num = 0;
                            if (isset($_SESSION['userid'])) {
                                $userid = $_SESSION['userid'];
                                $sql_num = "SELECT count(quantity) as num FROM cart where user_id=$userid";
                                $res_num = mysqli_query($connection, $sql_num);
                                if ($res_num->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($res_num)) {
                                        $num = $row['num'];
                                    }
                                    echo $num;
                                }
                                if ($res_num->num_rows == 0) {
                                    echo $num;
                                }
                            } else {
                                echo $num;
                            }
                            ?></span>
                    </a>
                </form>
            </div>
        </nav>
        <!-- !Primary Navigation -->

    </header>
    <!-- !start #header -->
    <!-- start #main-site -->
    <?php
        include("./pages/_billing.php");
    ?>
    <!-- !start #main-site -->
    <br>
    <br>
    <!-- start #footer -->
    <footer id="footer" class="bg-dark text-white py-5">

    </footer>
    <div class="copyright text-center bg-dark text-white py-2">
        <p class="font-rale font-size-14">&copy; Copyrights 2020. Desing By <a href="https://www.facebook.com/hoangnguyen210297" class="color-second">Hoàng Nguyễn</a></p>
    </div>
    <!-- !start #footer -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Owl Carousel Js file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

    <!--  isotope plugin cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>
    
    <!-- Custom Javascript -->
    <script src="index.js"></script>
</body>

</html>