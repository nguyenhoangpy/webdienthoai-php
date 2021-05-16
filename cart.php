<?php 
    require_once("header.php"); 
?>

<?php
    if (!$_SESSION['userid']){
        echo "<div class='alert alert-danger' role='alert'>Vui lòng đăng nhập trước! <a href='login.php'>Đăng nhập</a> hoặc quay lại <a href='index.php'>Trang chủ</a></div>";
    } else {
        require_once("./pages/__cart.php");
        require_once("./pages/banner_ads.php"); 
        // require_once("./pages/new_phone.php");
        require_once("footer.php");
    } 
?>      
