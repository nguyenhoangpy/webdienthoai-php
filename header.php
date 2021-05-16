<?php
require_once("./DB/DBControler.php");
require_once("./DB/Product.php");
require_once("./DB/AccounControler.php");
require_once("./DB/CartControler.php");
require_once("./DB/fb-login.php");
require_once("./DB/gg-login.php");
// session_start();
error_reporting(0);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>24H Store</title>

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <!-- Owl-carousel CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

  <!-- font awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- <link href="/dashboard/images/favicon.png" rel="icon" type="image/png" /> -->

  <!-- Custom CSS file -->
  <link rel="stylesheet" href="style.css">
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=464446248223742&autoLogAppEvents=1" nonce="IBT9SdVt"></script>

  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {

      window.addEventListener('scroll', function() {

        if (window.scrollY > 50) {
          document.getElementById('navbar_top').classList.add('fixed-top');
          // add padding top to show content behind navbar
          navbar_height = document.querySelector('.navbar').offsetHeight;
          document.body.style.paddingTop = navbar_height + 'px';
        } else {
          document.getElementById('navbar_top').classList.remove('fixed-top');
          // remove padding top from body
          document.body.style.paddingTop = '0';
        }
      });
    });
    // DOMContentLoaded  end
  </script>
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
      <a class="navbar-brand" href="./index.php">24H Store</a>
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
        <form class="font-size-14 font-opensans">
          <a href="cart.php" class="py-2 rounded-pill color-red-2-bg">
            <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
            <span class="px-3 py-2 rounded-pill text-dark bg-light">
              <?php
              $num = 0;
              if (isset($_SESSION['userid'])) {
                $userid = $_SESSION['userid'];              
                $sql_num = "SELECT count(quantity) as num FROM cart where user_id=$userid";
                $res_num = mysqli_query($connection, $sql_num);
                if ($res_num->num_rows >0) {
                  while ($row = mysqli_fetch_array($res_num)) {                   
                    $num = $row['num'];
                  }
                  echo $num;
                }
                if ($res_num->num_rows == 0){
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
  <main id="main-site">
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml: true,
          version: 'v10.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your Plugin chat code -->
    <div class="fb-customerchat" attribution="page_inbox" page_id="101016988804920">
    </div>