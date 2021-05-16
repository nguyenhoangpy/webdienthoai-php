<?php
require_once("DBControler.php");


if (isset($_POST['btn-add-sale'])) {
    $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);
    $item_price_sale = mysqli_real_escape_string($connection, $_POST['item_price']);
    $quantity = 1;
    if (!isset($_SESSION['userid'])) {
        echo "<script>alert('Đăng nhập trước khi mua hàng!');</script>";
    } else {
        $userid = $_SESSION['userid'];
        $sql_check = "select * from cart where user_id=$userid and item_id=$item_id";
        $result_check = mysqli_query($connection, $sql_check);
        if ($result_check->num_rows > 0) {
            $sql = "update cart set quantity = quantity + 1 where user_id=$userid and item_id=$item_id";
            $result = mysqli_query($connection, $sql);
            $sql1 = "update cart set sum = $item_price_sale*quantity where user_id=$userid and item_id=$item_id";
            $rs1 = mysqli_query($connection, $sql1);
            if ($rs1) {
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        } else {
            $sql_add = "insert into cart(user_id, item_id, quantity, sum) values ($userid,$item_id,$quantity,$item_price_sale)";
            $result_add = mysqli_query($connection, $sql_add);
            if ($result_add) {
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        }
    }
}

if (isset($_POST['btn-add-spec'])) {
    $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);
    $item_price = mysqli_real_escape_string($connection, $_POST['item_pri']);
    $quantity = 1;
    if (!isset($_SESSION['userid'])) {
        echo "<div class='alert alert-danger' role='alert'>Vui lòng đăng nhập trước khi mua hàng!</div>";
    } else {
        $userid = $_SESSION['userid'];
        $sql_check = "select * from cart where user_id=$userid and item_id=$item_id";
        $result_check = mysqli_query($connection, $sql_check);
        if ($result_check->num_rows > 0) {
            $sql = "update cart set quantity = quantity + 1 where user_id=$userid and item_id=$item_id";
            $result = mysqli_query($connection, $sql);
            $sql1 = "update cart set sum = $item_price*quantity where user_id=$userid and item_id=$item_id";
            $rs1 = mysqli_query($connection, $sql1);
            if ($rs1) {
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        } else {
            $sql_add = "insert into cart(user_id, item_id, quantity, sum) values ($userid,$item_id,$quantity,$item_price)";
            $result_add = mysqli_query($connection, $sql_add);
            if ($result_add) {
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        }
    }
}

if (isset($_POST['btn-add-list'])) {
    $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);
    $item_price = mysqli_real_escape_string($connection, $_POST['item_price_buy']);
    $quantity = 1;
    if (!isset($_SESSION['userid'])) {
        echo "<div class='alert alert-danger' role='alert'>Vui lòng đăng nhập trước khi mua hàng!</div>";
    } else {
        $userid = $_SESSION['userid'];
        $sql_check = "select * from cart where user_id=$userid and item_id=$item_id";
        $result_check = mysqli_query($connection, $sql_check);
        if ($result_check->num_rows > 0) {
            $sql = "update cart set quantity = quantity + 1 where user_id=$userid and item_id=$item_id";
            $result = mysqli_query($connection, $sql);
            $sql1 = "update cart set sum = $item_price*quantity where user_id=$userid and item_id=$item_id";
            $rs1 = mysqli_query($connection, $sql1);
            if ($rs1) {
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        } else {
            $sql_add = "insert into cart(user_id, item_id, quantity, sum) values ($userid,$item_id,$quantity,$item_price)";
            $result_add = mysqli_query($connection, $sql_add);
            if ($result_add) {
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        }
    }
}

if (isset($_POST['btn-addcart'])) {
    $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);
    $item_price = mysqli_real_escape_string($connection, $_POST['item_price_buy']);
    $quantity = 1;
    if (!isset($_SESSION['userid'])) {
        echo "<div class='alert alert-danger' role='alert'>Vui lòng đăng nhập trước khi mua hàng!</div>";
    } else {
        $userid = $_SESSION['userid'];
        $sql_check = "select * from cart where user_id=$userid and item_id=$item_id";
        $result_check = mysqli_query($connection, $sql_check);
        if ($result_check->num_rows > 0) {
            $sql = "update cart set quantity = quantity + 1 where user_id=$userid and item_id=$item_id";
            $result = mysqli_query($connection, $sql);
            $sql1 = "update cart set sum = $item_price*quantity where user_id=$userid and item_id=$item_id";
            $rs1 = mysqli_query($connection, $sql1);
            if ($rs1) {
                header("Location: product_detail.php?item_id=" . $item_id . "");
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        } else {
            $sql_add = "insert into cart(user_id, item_id, quantity, sum) values ($userid,$item_id,$quantity,$item_price)";
            $result_add = mysqli_query($connection, $sql_add);
            if ($result_add) {
                header("Location: product_detail.php?item_id=" . $item_id . "");
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        }
    }
}

if (isset($_POST['btn-buynow'])) {
    $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);
    $item_price = mysqli_real_escape_string($connection, $_POST['item_price_buy']);
    $quantity = 1;
    if (!isset($_SESSION['userid'])) {
        echo "<div class='alert alert-danger' role='alert'>Vui lòng đăng nhập trước khi mua hàng!</div>";
    } else {
        $userid = $_SESSION['userid'];
        $sql_check = "select * from cart where user_id=$userid and item_id=$item_id";
        $result_check = mysqli_query($connection, $sql_check);
        if ($result_check->num_rows > 0) {
            $sql = "update cart set quantity = quantity + 1 where user_id=$userid and item_id=$item_id";
            $result = mysqli_query($connection, $sql);
            $sql1 = "update cart set sum = $item_price*quantity where user_id=$userid and item_id=$item_id";
            $rs1 = mysqli_query($connection, $sql1);
            if ($rs1) {
                header("Location: cart.php");
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        } else {
            $sql_add = "insert into cart(user_id, item_id, quantity, sum) values ($userid,$item_id,$quantity,$item_price)";
            $result_add = mysqli_query($connection, $sql_add);
            if ($result_add) {
                header("Location: cart.php");
            } else {
                echo "<div class='alert alert-danger' role='alert'>Thêm sản phẩm thất bại!</div>";
            }
        }
    }
}

if (isset($_POST['btn-delpro'])) {
    $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);
    $userid = $_SESSION['userid'];
    $sql_del = "delete from cart where user_id=$userid and item_id=$item_id";
    $result = mysqli_query($connection, $sql_del);
    if ($result) {
        header("Location: " . $_SERVER["PHP_SELF"]);
    } else {
        echo "<div class='alert alert-danger' role='alert'>Xóa sản phẩm thất bại!</div>";
    }
}

if (isset($_POST['order'])){
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $bill_id = mysqli_real_escape_string($connection, $_POST['bill_id']);
    $total = mysqli_real_escape_string($connection, $_POST['total']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $note = mysqli_real_escape_string($connection, $_POST['note']);
    $sql_check = "select * from ";
    if($fullname=="" || $address=="" || $phone=="" || $note==""){
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    } else {
        header("Location: payments.php?bill_id=".$bill_id."&total=".$total."");
    }    
}
?>