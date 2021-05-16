<?php
require_once("./DB/CartControler.php");
?>

<?php

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}
$sum = 0;
$sql_num = "SELECT sum(quantity) as num, sum(sum) as sum FROM cart where user_id=$userid";
$res_num = mysqli_query($connection, $sql_num);
if ($res_num->num_rows > 0) {
    while ($row = mysqli_fetch_array($res_num)) {
        $num = $row['num'];
        $sum = $row['sum'];
    }
} else {
    echo $sum;
}
?>

<main id="main-site">
    <div class="container">
        <nav class="color-white-bg" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="cart.php">Giỏ hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
            </ol>
        </nav>
        <h3 class="text-center">Xác nhận đơn hàng</h3>
        <div class="row">
            <div class="row col-sm-8">
                <?php
                foreach ($product->getCart($userid) as $item) :
                ?>
                    <div class="row border-top py-3 mt-3">
                        <div class="col-sm-2">
                            <img src="<?php echo $item['item_image'] ?? $item['item_image'] ?>" alt="cart1" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="font-opensans font-size-20"><?php echo $item['item_name'] ?? $item['item_name']; ?></h5>
                            <span>Số lượng: <?php echo $item['quantity'] ?? $item['quantity'] ?></span>
                        </div>
                        <div class="col-sm-2 text-right">
                            <h5 class="font-opensans font-size-20 text-danger"><?php echo number_format($item['sum'], 0, '.', '.'); ?>đ</h5>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
                <div class="row py-3 mt-3">
                    <div class="col-md text-right">
                        <h5 class="font-opensans font-size-22">Tổng cộng:</h5>
                    </div>
                    <div class="col-md text-right">
                        <h5 class="font-opensans font-size-22 text-danger"><?php echo number_format($sum, 0, '.', '.'); ?>đ</h5>
                    </div>

                </div>
            </div>
            <div class="col-sm-4" style="margin-left: 30px;">
                <div class="table-responsive">
                    <form method="post">
                        <div class="form-group">
                            <label for="fullname">Tên khách hàng </label>
                            <?php if (isset($_SESSION['fullname'])) {
                                $fullname = $_SESSION['fullname'];
                            ?>
                                <input class="form-control" id="fullname" name="fullname" type="text" value="<?= $fullname ?>" />
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="bill_id">Mã hóa đơn</label>
                            <?php $id = date("YmdHis"); ?>
                            <input type="hidden" id="bill_id" name="bill_id" type="text" value="<?php echo $id ?>" />
                            <input class="form-control" type="text" readonly value="<?php echo $id ?>" />
                        </div>
                        <div class="form-group">
                            <label for="total">Số tiền</label>
                            <?php
                            $sum = 0;
                            $sql_sum = "SELECT sum(sum) as sum FROM cart where user_id=$userid";
                            $res_sum = mysqli_query($connection, $sql_sum);
                            if ($res_sum->num_rows > 0) {
                                while ($row = mysqli_fetch_array($res_sum)) {
                                    $sum = $row['sum'];
                                }
                            ?>
                                <input type="hidden" id="total" name="total" type="number" value="<?php echo $sum ?>" />
                                <input class="form-control" type="number" readonly value="<?php echo $sum ?>" />
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ nhận hàng</label>
                            <textarea class="form-control" cols="20" id="address" name="address" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Điện thoại</label>
                            <input class="form-control" id="phone" name="phone" type="number">
                        </div>
                        <div class="form-group">
                            <label for="note">Ghi chú</label>
                            <textarea class="form-control" cols="20" id="note" name="note" rows="2"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" name="order" value="Thanh toán">
                        <!-- <button type="submit" class="btn btn-default">Thanh toán Redirect</button> -->
                        <a href="index.php"><button type="button" class="btn btn-danger">Tiếp tục mua hàng</button></a>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>