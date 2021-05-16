<?php
require_once("./DB/DBControler.php");
require_once("./DB/AccounControler.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khôi phục tài khoản</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: login.php');
} else{
    echo "<div class='alert alert-success' role='alert'>Đã gửi mã xác minh khôi phục tài khoản tới email của bạn - '$email'</div>";
}
?>
    <header>
        <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
            <p class="font-opensans font-size-12 text-black-50 m-0">Hoàng Nguyễn - Faculty of Information Technology (HUTECH)
                - (034) 44776653</p>
            <div class="font-rale font-size-14">
                <a href="#" class="px-3 border-right border-left text-dark">Tin Tức Công Nghệ</a>
                <!-- <a href="#" class="px-3 border-right border-left text-dark">Đăng nhập</a> -->
                <!-- <a href="#" class="px-3 border-right text-dark">Whishlist (0)</a> -->
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-nav">
            <a class="navbar-brand" href="index.php">24H Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

    </header>
    <br> <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- <a href="/Shop_Mobile_PHP_MySQL/index.php" class="color-red">Về trang chủ</a> -->
            </div>
            <div class="col-5">
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã xác nhận khôi phục mật khẩu:</label>
                        <input type="number" name="otp" class="form-control" id="exampleOTPEmail1" aria-describedby="emailHelp" placeholder="Nhập mã xác nhận">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="checkcode_reset" class="btn btn-outline-warning btn-block" value="Khôi phục mật khẩu">
                    </div>
                </form>
            </div>
            <div class="col">
            </div>
        </div>

    </div>
    <br>