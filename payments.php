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
<?php
if (isset($_GET['bill_id']) && isset($_GET['total'])) {
    $order_id = $_GET['bill_id'];
    $sum = $_GET['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xác nhận thanh toán</title>

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
    <main id="main-site">
        <div class="container">
            <nav class="color-white-bg" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Giỏ hàng</a></li>
                    <li class="breadcrumb-item"><a href="billing.php">Đặt hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                </ol>
            </nav>
            <div class="">
                <h3 class="text-center">Xác nhận thanh toán</h3>
            </div>
            <div class="row">
                <div class="col-sm">

                </div>
                <div class="col-sm">
                    <div class="table-responsive">
                        <form action="./vnpay_php/vnpay_create_payment.php" id="create_form" method="post">
                            <div class="form-group">
                                <label for="language">Tên khách hàng </label>
                                <?php if (isset($_SESSION['fullname'])) {
                                    $fullname = $_SESSION['fullname'];
                                ?>
                                    <input class="form-control" type="text" readonly value="<?= $fullname ?>" />
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="order_id">Mã hóa đơn</label>
                                <input type="hidden" id="order_type" name="order_type" type="text" value="billpayment">
                                <!-- <?php $date = date("YmdHis"); ?> -->
                                <input type="hidden" id="order_id" name="order_id" type="text" value="<?php echo $order_id ?>" />
                                <input class="form-control" type="text" readonly value="<?php echo $order_id ?>" />
                                <!--<input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" />-->
                            </div>
                            <div class="form-group">
                                <label for="amount">Số tiền</label>
                                <!-- <?php
                                        $sum = 0;
                                        $sql_sum = "SELECT sum(sum) as sum FROM cart where user_id=$userid";
                                        $res_sum = mysqli_query($connection, $sql_sum);
                                        if ($res_sum->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($res_sum)) {
                                                $sum = $row['sum'];
                                            }
                                        ?> -->
                                <input type="hidden" id="amount" name="amount" type="number" value="<?php echo $sum ?>" />
                                <input class="form-control" type="number" readonly value="<?php echo $sum ?>" />
                                <!--<input class="form-control" id="amount" name="amount" type="number" value="<?php echo $sum ?>" />-->
                            <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="order_desc">Ghi chú</label>
                                <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Ghi tieng viet khong dau</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bank_code">Ngân hàng</label>
                                <select name="bank_code" id="bank_code" class="form-control">
                                    <option value="">--Chọn ngân hàng--</option>
                                    <option value="NCB"> Ngân hàng NCB</option>
                                    <option value="AGRIBANK"> Ngân hàng Agribank</option>
                                    <option value="SCB"> Ngân hàng SCB</option>
                                    <option value="SACOMBANK">Ngân hàng SacomBank</option>
                                    <option value="EXIMBANK"> Ngân hàng EximBank</option>
                                    <option value="MSBANK"> Ngân hàng MSBANK</option>
                                    <option value="NAMABANK"> Ngân hàng NamABank</option>
                                    <option value="VNMART"> Ví điện tử VnMart</option>
                                    <option value="VIETINBANK"> Ngân hàng Vietinbank</option>
                                    <option value="VIETCOMBANK"> Ngân hàng VCB</option>
                                    <option value="HDBANK">Ngân hàng HDBank</option>
                                    <option value="DONGABANK"> Ngân hàng Đông Á</option>
                                    <option value="TPBANK"> Ngân hàng TPBank</option>
                                    <option value="OJB"> Ngân hàng OceanBank</option>
                                    <option value="BIDV"> Ngân hàng BIDV</option>
                                    <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                    <option value="VPBANK"> Ngân hàng VPBank</option>
                                    <option value="MBBANK"> Ngân hàng MBBank</option>
                                    <option value="ACB"> Ngân hàng ACB</option>
                                    <option value="OCB"> Ngân hàng OCB</option>
                                    <option value="IVB"> Ngân hàng IVB</option>
                                    <option value="VISA"> Thanh toán qua VISA/MASTER</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="language">Ngôn ngữ</label>
                                <select name="language" id="language" class="form-control">
                                    <option value="vn">Tiếng Việt</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán</button>
                            <!-- <button type="submit" class="btn btn-default">Thanh toán Redirect</button> -->
                            <a href="cart.php"><button type="button" class="btn btn-danger">Quay lại giỏ hàng</button></a>
                        </form>
                    </div>
                </div>
                <div class="col-sm">

                </div>
            </div>

        </div>
    </main>
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
    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        $("#btnPopup").click(function() {
            var postData = $("#create_form").serialize();
            var submitUrl = $("#create_form").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function(x) {
                    if (x.code === '00') {
                        if (window.vnpay) {
                            vnpay.open({
                                width: 768,
                                height: 600,
                                url: x.data
                            });
                        } else {
                            location.href = x.data;
                        }
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
            return false;
        });
    </script>
    <!-- Custom Javascript -->
    <script src="index.js"></script>
</body>

</html>