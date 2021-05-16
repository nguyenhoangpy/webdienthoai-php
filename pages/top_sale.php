<?php
require_once("./DB/CartControler.php");
?>
<?php

$product_shuffle = $product->getSale();
shuffle($product_shuffle);

?>
<!-- Top Sale -->
<section id="top-sale">
  <div class="container py-5">
    <p class="mb-0">
      <strong class="d-flex align-items-center">
        <img class="cpslazy loaded" data-src="https://cellphones.com.vn/media/icon/flash.gif" data-ll-status="loaded" src="https://cellphones.com.vn/media/icon/flash.gif">
        <label class="font-opensans font-size-20 color-red">HOT SALES</label>
      </strong>
    </p>
    <hr>
    <!-- owl carousel -->
    <div class="owl-carousel owl-theme">
      <?php
      foreach ($product_shuffle as $item) { ?>
        <div class="item py-2" style="width: 200px;">
          <div class="product font-opensans">
            <div class="heightlabel">
              <label class="installment color-yellow-bg">Trả góp <b>0%</b></label>
            </div>
            <a href="product_detail.php?item_id=<?php echo $item['item_id'] ?>"><img src="<?php echo $item['item_image'] ?? "../assets/products/iphone-12promax128gb.jpg" ?>" alt="iphone-12promax128gb" class="img-fluid"></a>
            <div class="text-center">
              <h6 class="font-opensans"><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
              <div class="rating text-warning font-size-12">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="far fa-star"></i></span>
              </div>
              <div class="price py-2">
                <strong class="font-opensans color-red"><?php echo number_format($item['item_price_sale'], 0, '.', '.') ?>đ</strong>
                <span class="font-opensans" style="text-decoration: line-through;"><?php echo number_format($item['item_price'], 0, '.', '.') ?>đ</span>
              </div>             
              <form method="POST">
                <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                <input type="hidden" name="item_price" value="<?php echo $item['item_price_sale']; ?>">
                <button type="submit" name="btn-add-sale" class="btn btn-warning btn-rounded font-size-12">Thêm vào giỏ hàng</button>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
</section>
<!-- !Top Sale -->