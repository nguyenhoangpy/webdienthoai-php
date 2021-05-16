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

<section id="cart">
    <div class="container-fluid w-75">
        <nav class="color-white-bg" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>
        <h5 class="font-opensans font-size-20">Thông tin giỏ hàng</h5>
        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                foreach ($product->getCart($userid) as $item) :
                ?>
                    <!-- cart item -->
                    <div class="row border-top py-3 mt-3">
                        <div class="col-sm-2">
                            <img src="<?php echo $item['item_image'] ?? $item['item_image'] ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="font-opensans font-size-20"><?php echo $item['item_name'] ?? $item['item_name']; ?></h5>
                            <small><?php echo $item['item_brand'] ?? $item['item_brand'] ?></small>
                            <!-- product rating -->
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                </div>
                                <!-- <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a> -->
                            </div>
                            <!--  !product rating-->

                            <!-- product qty -->
                            <div class="qty d-flex pt-2">
                                <div class="d-flex font-rale w-25">
                                    <button class="qty-down border bg-light" data-id="pro1"><i class="fas fa-angle-down"></i></button>
                                    <input type="text" data-id="pro1" class="qty_input border px-2 w-100 bg-light" disabled value="<?php echo $item['quantity'] ?? $item['quantity'] ?>">
                                    <button data-id="pro1" class="qty-up border bg-light"><i class="fas fa-angle-up"></i></button>
                                </div>
                                <form method="POST">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                    <button type="submit" name="btn-delpro" class="btn font-opensans text-danger px-3 border-right">Xóa</button>
                                </form>
                            </div>
                            <!-- !product qty -->

                        </div>

                        <div class="col-sm-2 text-right">
                            <div class="font-size-20 text-danger font-opensans">
                                <span class="product_price"><?php echo number_format($item['sum'], 0, '.', '.') ?>đ</span>
                            </div>
                        </div>
                    </div>
                    <!-- !cart item -->
                    <!-- cart item -->

                    <!-- !cart item -->
                <?php
                endforeach;
                ?>
            </div>

            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-opensans text-success py-3"><i class="fas fa-check"></i>Miễn phí giao hàng</h6>
                    <div class="border-top py-4">
                        <h5 class="font-opensans font-size-20">Tổng cộng:&nbsp; <span class="text-danger"><span class="text-danger" id="deal-price"><?php echo number_format($sum, 0, '.', '.'); ?></span>đ</span> </h5>
                        <a href="billing.php">
                            <button type="submit" class="btn btn-warning mt-3">Đặt hàng</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>

</section>