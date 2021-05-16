<?php
require_once("./DB/CartControler.php");
?>

<?php
$item_id = $_GET['item_id'] ?? 1;
foreach ($product->getData('product') as $item) :
    if ($item['item_id'] == $item_id) :
?>
        <section id="product">
            <div class="container">
                <nav class="color-white-bg" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="list_product.php">Điện thoại</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $item['item_name'] ?? $item['item_name'] ?></li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo $item['item_image'] ?? $item['item_image'] ?>" alt="product" class="img-fluid">
                        <div class="form-row pt-4 font-size-16 font-opensans">
                            <a href="./img_360.php?item_id=<?php echo $item['item_id']; ?>" class="align-item">Xem ảnh 360 độ sản phẩm</a>
                        </div>
                        <div class="form-row pt-4 font-size-16 font-opensans">
                            <div class="col">
                                <form method="POST">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? 1; ?>">
                                    <input type="hidden" name="item_price_buy" value="<?php
                                                                                        if ($item['item_price_sale'] == 0) {
                                                                                            echo $item['item_price'];
                                                                                        } else {
                                                                                            echo $item['item_price_sale'];
                                                                                        }
                                                                                        ?>">
                                    <button type="submit" name="btn-buynow" class="btn btn-danger form-control">Mua ngay</button>
                                </form>
                            </div>
                            <div class="col">
                                <form method="POST">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? 1; ?>">
                                    <input type="hidden" name="item_price_buy" value="<?php
                                                                                        if ($item['item_price_sale'] == 0) {
                                                                                            echo $item['item_price'];
                                                                                        } else {
                                                                                            echo $item['item_price_sale'];
                                                                                        }
                                                                                        ?>">
                                    <button type="submit" name="btn-addcart" class="btn btn-warning form-control">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 py-5">
                        <h5 class="font-opensans font-size-24" style="font-weight: bold"><?php echo $item['item_name'] ?? $item['item_name'] ?></h5>
                        <small><?php echo $item['item_brand'] ?? $item['item_brand'] ?></small>
                        <div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <!-- <a href="#" class="px-2 font-rale font-size-14">20,534 ratings | 1000+ answered questions</a> -->
                        </div>
                        <hr class="m-0">

                        <!---    product price       -->
                        <table class="my-3">
                            <?php
                            if ($item['item_price_sale'] != 0) {
                                echo "
                                    <tr class='font-opensans font-size-16'>
                                        <td>Giá gốc: </td>
                                        <td style='font-weight: bold'><strike></strike>" . number_format($item['item_price'], 0, '.', '.') . "đ</td>
                                    </tr>
                                    <tr class='font-opensans font-size-14'>
                                        <td>Giá KM: </td>
                                        <td class='font-size-20 text-danger' style='font-weight: bold'>" . number_format($item['item_price_sale'], 0, '.', '.') . "đ</td>
                                    </tr>
                                    <tr class='font-opensans font-size-14'>
                                        <td>Tiết kiệm:</td>
                                    <td><span class='font-size-16 text-danger' style='font-weight: bold'>" . number_format($item['item_price'] - $item['item_price_sale'], 0, '.', '.') . "đ</span></td>
                                    </tr>
                                    ";
                            } else {
                                echo "
                                <tr class='font-opensans font-size-16'>
                                    <td>Giá:</td>
                                    <td style='font-weight: bold'><strike></strike>" . number_format($item['item_price'], 0, '.', '.') . "đ</td>
                                </tr>
                                ";
                            }
                            ?>
                        </table>
                        <!---    !product price       -->

                        <!--    #policy -->
                        <div id="policy">
                            <div class="d-flex">
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">7 ngày <br> đổi trả</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-truck  border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">Miễn phí giao hàng<br>nội thành TP.HCM</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">Bảo hành<br>1 năm</a>
                                </div>
                            </div>
                        </div>
                        <!--    !policy -->
                        <hr>

                        <!-- order-details -->
                        <!-- <div id="order-details" class="font-rale d-flex flex-column text-dark">
                    <small>Delivery by : Mar 29 - Apr 1</small>
                    <small>Sold by <a href="#">Daily Electronics </a>(4.5 out of 5 | 18,198 ratings)</small>
                    <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
                </div> -->
                        <!-- !order-details -->

                        <div class="row">
                            <div class="col-6">
                                <!-- color -->
                                <div class="color my-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="font-opensans">Color:</h6>
                                        <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                    </div>
                                </div>
                                <!-- !color -->
                            </div>
                            <div class="col-6">
                                <!-- <div class="qty d-flex">
                                    <h6 class="font-opensans">Số lượng</h6>
                                    <div class="px-4 d-flex font-rale">
                                        <form method="POST">
                                            <button class="qty-down border bg-light" data-id="pro1"><i class="fas fa-angle-down"></i></button>
                                            <input type="text" name="quantity" data-id="pro1" class="qty_input border px-2 w-50 bg-light" disabled value="1">
                                            <button data-id="pro1" class="qty-up border bg-light"><i class="fas fa-angle-up"></i></button>
                                        </form>

                                    </div>
                                </div>                               -->
                            </div>
                        </div>

                        <!-- size -->
                        <div class="size my-3">
                            <h6 class="font-opensans">Size :</h6>
                            <div class="d-flex justify-content-between w-75">
                                <div class="font-rubik border p-2">
                                    <button class="btn p-0 font-size-14">4GB RAM</button>
                                </div>
                                <div class="font-rubik border p-2">
                                    <button class="btn p-0 font-size-14">6GB RAM</button>
                                </div>
                                <div class="font-rubik border p-2">
                                    <button class="btn p-0 font-size-14">8GB RAM</button>
                                </div>
                            </div>
                        </div>
                        <!-- !size -->


                    </div>

                    <div class="col-12" style="margin-top: 15px;">
                        <h6 class="font-opensans font-size-16">Chi tiết sản phẩm</h6>
                        <hr>
                        <p class="font-rale font-size-14">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit numquam a aliquam vitae vel?</p>
                        <p class="font-rale font-size-14">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit numquam a aliquam vitae vel?</p>
                    </div>
                </div>
                <div class="row">
                    <div class="fb-like" data-href="https://cuahangdidong24h.000webhostapp.com/product_detail.php?item_id=$item['item_id']" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>

                </div>
                <div class="row">
                    <div class="fb-comments" data-href="https://cuahangdidong24h.000webhostapp.com/product_detail.php" data-width="" data-numposts="5"></div>
                </div>
            </div>
        </section>

<?php
    endif;
endforeach;
?>