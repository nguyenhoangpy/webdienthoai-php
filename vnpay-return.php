<?php
include("./DB/DBControler.php");
include("./DB/Product.php");
include("./DB/AccounControler.php");
include("./DB/CartControler.php");
include("./DB/fb-login.php");
include("./DB/gg-login.php");
// session_start();
error_reporting(0);
?>
<?php
require_once("./vnpay_php/config.php");
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}
unset($inputData['vnp_SecureHashType']);
unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . $key . "=" . $value;
    } else {
        $hashData = $hashData . $key . "=" . $value;
        $i = 1;
    }
}

//$secureHash = md5($vnp_HashSecret . $hashData);
$kq_tt = '';
$kq_mail = '';
$secureHash = hash('sha256', $vnp_HashSecret . $hashData);
if ($secureHash == $vnp_SecureHash) {
    if ($_GET['vnp_ResponseCode'] == '00') {
        $email = $_SESSION['email'];
        $order_id = $_GET['vnp_TxnRef'];
        $thanh_vien = $_SESSION['fullname'];
        $money = $_GET['vnp_Amount'] / 100;
        $note = $_GET['vnp_OrderInfo'];
        $vnp_response_code = $_GET['vnp_ResponseCode'];
        $code_vnpay = $_GET['vnp_TransactionNo'];
        $code_bank = $_GET['vnp_BankCode'];
        $time = $_GET['vnp_PayDate'];
        $date_time = substr($time, 0, 4) . "-" . substr($time, 4, 2) . "-" . substr($time, 6, 2) . " " . substr($time, 8, 2) . ":" . substr($time, 10, 2) . ":" . substr($time, 12, 2);
        $sql = "select * from payments where order_id='$order_id'";
        //echo $sql;
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $sql = "update payments set order_id='$order_id', thanh_vien='$thanh_vien', money='$money', note='$note', vnp_response_code='$vnp_response_code', code_vnpay='$code_vnpay', code_bank='$code_bank', time='$date_time'";
            //echo $sql;
            $result = mysqli_query($connection, $sql);
        } else {
            $sql = "insert into payments(order_id, thanh_vien, money, note, vnp_response_code, code_vnpay, code_bank, time) values ('$order_id', '$thanh_vien', '$money', '$note', '$vnp_response_code', '$code_vnpay', '$code_bank', '$date_time')";
            //echo $sql;
            $result = mysqli_query($connection, $sql);
        }
        $sql_delcart = "delete from cart where user_id='" . $_SESSION['userid'] . "'";
        $res = mysqli_query($connection, $sql_delcart);
        $subject = "X??c nh???n ????n h??ng #$order_id";
        $message = "C???m ??n $thanh_vien ???? mua s???m t???i https://cuahangdidong24h.tk . ????n h??ng c???a b???n ???? ???????c ghi nh???n.  \nM?? ????n h??ng:$order_id \nTh???i gian ?????t h??ng:$date_time \nGi?? tr??? ????n h??ng:" . number_format($money, 0, '.', '.'). " \nThanh to??n: ???? thanh to??n. \n";
        if (mail($email, $subject, $message)) {
            $kq_mail = "???? g???i email x??c nh???n ????n h??ng";
        }
        $kq_tt = 'GD Thanh cong';
        //echo $kq_tt;
    } else {
        $kq_tt = 'GD Khong thanh cong';
        //echo $kq_tt;
    }
} else {
    $kq_tt = 'Chu ky khong hop le';
    //echo $kq_tt;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>X??c nh???n thanh to??n</title>

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
            <p class="font-opensans font-size-12 text-black-50 m-0">Ho??ng Nguy???n - Faculty of Information Technology (HUTECH)
                - (034) 44776653</p>
            <div class="font-opensans font-size-14 ">
                <a href="#" class="px-3 border-right border-left text-dark">Tin T???c C??ng Ngh???</a>
                <?php
                if (!$_SESSION['fullname']) {
                    echo "<a href='login.php' class='px-3 border-right border-left text-dark'>????ng nh???p</a>";
                } else {
                    echo "<a href='#' class='px-3 border-right border-left text-dark'>" . $_SESSION['fullname'] . "</a>";
                    echo "<a href='logout.php' class='px-3 border-right border-left text-dark'>????ng xu???t</a>";
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
                        <a class="nav-link" href="list_product_sale.php">Khuy???n M??i</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="list_product.php">Smartphone</a>
                        <!-- </li><li class="nav-item">
            <a class="nav-link" href="/Shop_Mobile_PHP_MySQL/list_product.php">Laptop</a>
          </li> -->
                        <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Danh M???c
            </a>
            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item color-red" href="#">Smartphone</a>
              <a class="dropdown-item color-red" href="#">Laptop</a>
              <a class="dropdown-item color-red" href="#">Ph??? ki???n</a>
            </div>
          </li> -->
                        <!-- <li class="nav-item">
            <a class="nav-link" href="#">24H C??ng Ngh???</a>
          </li> -->
                        <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a>
                      </li> -->
                    <li class="nav-item active">
                        <a class="nav-link" href="news.php">S???p ra m???t</a>
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
            <h3 class="text-center"><?php echo $kq_tt; ?></h3>
            <?php
            if ($kq_tt == "GD Thanh cong") {
                echo "
                    <h4 class='text-center'>C???m ??n qu?? kh??ch h??ng ???? mua s???m t???i <a href='index.php'>24H Store</a></h4>
                    <h5 class='text-center'>Ch??ng t??i ???? g???i email x??c nh???n ????n h??ng t???i " . $email . " . N???u c?? b???t c??? ph???n h???i n??o xin li??n h??? l???i v???i ch??ng t??i ngay.</h5>
                ";
            } else {
                echo "
                    <h4 class='text-center'>C???m ??n qu?? kh??ch. Giao d???ch c???a qu?? kh??ch kh??ng th??nh c??ng do ch??a thanh to??n ho???c b??? l???i trong qu?? tr??nh thanh to??n. N???u c?? b???t c??? ph???n h???i n??o xin h??y li??n h??? v???i ch??ng t??i ngay.</h4>
                ";
            }
            ?>
            <!--Begin display -->
            <div class="container">
                <div class="table-responsive">
                    <div class="form-group">
                        <label>Kh??ch h??ng:</label>
                        <label><?php echo $thanh_vien ?></label>
                    </div>
                    <div class="form-group">
                        <label>M?? ????n h??ng:</label>
                        <label><?php echo $order_id ?></label>
                    </div>
                    <div class="form-group">
                        <label>S??? ti???n:</label>
                        <label><?php echo number_format($money, 0, '.', '.') ?>??</label>
                    </div>
                    <div class="form-group">
                        <label>N???i dung thanh to??n:</label>
                        <label><?php echo $note ?></label>
                    </div>
                    <div class="form-group">
                        <label>M?? ph???n h???i (vnp_ResponseCode):</label>
                        <label><?php echo $vnp_response_code ?></label>
                    </div>
                    <div class="form-group">
                        <label>M?? GD T???i VNPAY:</label>
                        <label><?php echo $code_vnpay ?></label>
                    </div>
                    <div class="form-group">
                        <label>M?? Ng??n h??ng:</label>
                        <label><?php echo $code_bank ?></label>
                    </div>
                    <div class="form-group">
                        <label>Th???i gian thanh to??n:</label>
                        <label><?php
                                // $time = $_GET['vnp_PayDate'];
                                echo $date_time;
                                ?></label>
                    </div>
                    <!-- <div class="form-group">
                        <label>K???t qu???:</label>
                        <label><?php echo $kq_tt; ?></label>
                    </div> -->
                    <div class="form-group">
                        <a href="index.php"><button type="button" class="btn btn-danger">Trang ch???</button></a>
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
        <p class="font-rale font-size-14">&copy; Copyrights 2020. Desing By <a href="https://www.facebook.com/hoangnguyen210297" class="color-second">Ho??ng Nguy???n</a></p>
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

    <!-- Custom Javascript -->
    <script src="index.js"></script>
</body>

</html>