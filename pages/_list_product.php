<?php
require_once("./DB/CartControler.php");
?>

<?php
$product_shuffle = $product->getData('product');
$brand = array_map(function ($product) {
    return $product['item_brand'];
}, $product_shuffle);
$unique = array_unique($brand);
sort($unique);


?>
<!-- Special Price -->
<section id="special-price">
    <div class="container">
        <nav class="color-white-bg" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Điện thoại</li>
            </ol>
        </nav>
        <section id="banner-area">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="./assets/banner-deal02.png" alt="Banner1">
                </div>
                <div class="item">
                    <img src="./assets/banner-deal.png" alt="Banner2">
                </div>
                <div class="item">
                    <img src="./assets/banner-deal03.jpg" alt="Banner3">
                </div>
            </div>
        </section>
        <!-- <h4 class="font-opensans font-size-20">ĐIỆN THOẠI</h4> -->
        <div id="filters" class="button-group text-right font-opensans font-size-16">
            <button class="btn is-checked btn-danger" data-filter="*">Tất cả</button>
            <?php
            array_map(function ($brand) {
                echo "  <button class='btn btn-danger' data-filter='.$brand'>$brand</button>";
            }, $unique);
            ?>
        </div>

        <div class="grid">
            <?php array_map(function ($item) { ?>
                <div class="grid-item border <?php echo $item['item_brand'] ?? "Brand" ?>">
                    <div class="item py-2" style="width: 200px;">
                        <div class="product font-opensans">
                            <div class="heightlabel">
                                <label class="installment color-yellow-bg">Trả góp <b>0%</b></label>
                            </div>
                            <a href="product_detail.php?item_id=<?php echo $item['item_id'] ?>"><img src="<?php echo $item['item_image'] ?? "./assets/products/samsung-galaxy-s21-5g.jpg"; ?>" alt="samsung-galaxy-s21-5g" class="img-fluid"></a>
                            <div class="text-center">
                                <h6 class="font-opensans"><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                                <div class="price py-2">
                                    <?php
                                    if ($item['item_price_sale'] == 0) {
                                        echo "<strong class='font-opensans color-red'>" . number_format($item['item_price'], 0, '.', '.') . "đ</strong>";
                                    } else {
                                        echo "
                                                <strong class='font-opensans color-red'>" . number_format($item['item_price_sale'], 0, '.', '.') . "đ</strong>
                                                <span class='font-opensans' style='text-decoration: line-through;'>" . number_format($item['item_price'], 0, '.', '.') . "đ</span>
                                            ";
                                    }
                                    ?>

                                </div>
                                <form method="POST">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? 1; ?>">
                                    <input type="hidden" name="item_price_buy" value="<?php
                                                                                        if ($item['item_price_sale'] == 0) {
                                                                                            echo $item['item_price'];
                                                                                        } else {
                                                                                            echo $item['item_price_sale'];
                                                                                        }
                                                                                        ?>">
                                    <button type="submit" name="btn-add-list" class="btn btn-warning font-size-12">Thêm vào giỏ hàng</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }, $product_shuffle) ?>
        </div>
        <section id="banner_adds">
            <div class="container py-5 text-center">
                <a href="#"><img src="./assets/banner-deal04.jpg" alt="banner3" class="img-fluid"></a>
            </div>
        </section>
    </div>
</section>
<!-- !Special Price -->