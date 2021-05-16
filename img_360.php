<?php
require_once("header.php");
?>

<?php
$item_id = $_GET['item_id'] ?? 1;
foreach ($product->getData('product') as $item) :
    if ($item['item_id'] == $item_id) :
?>
        <div class="container">
            <nav class="color-white-bg" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="list_product.php">Điện thoại</a></li>
                    <li class="breadcrumb-item"><a href="product_detail.php?item_id=<?php echo $item['item_id'] ?>"><?php echo $item['item_name'] ?? $item['item_name'] ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Xem ảnh xoay 360 độ</li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div>
                        <h5 class="font-opensans font-size-20" style="font-weight: bold; margin-left: 160px"><?php echo $item['item_name'] ?? $item['item_name'] ?></h5>
                    </div>
                    <div>
                        <?php
                        if ($item['item_price_sale'] == 0) {
                            echo "<span class='font-opensans' style='margin-left: 160px;'>" . number_format($item['item_price'], 0, '.', '.') . "đ</span>";
                        } else {
                            echo "
                                <strong class='font-opensans color-red' style='margin-left: 160px;'>" . number_format($item['item_price_sale'], 0, '.', '.') . "đ</strong>
                                <span class='font-opensans' style='text-decoration: line-through;'>" . number_format($item['item_price'], 0, '.', '.') . "đ</span>
                                ";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <br>
                    <button type="submit" name="btn-addtocart" class="btn btn-warning">Thêm vào giỏ hàng</button>
                </div>
            </div>
            <br>
            <img class="mx-auto d-block" id="productImg">
        </div>
        <script>
            // let imgPrefix = `https://cdn.tgdd.vn/Products/Images/42/213033/Image360/iphone-12-pro-max-360-org`;
            let imgPrefix = `<?php echo $item['item_link']; ?>`;
            let i = 0;
            setInterval(() => {
                $("#productImg").attr("src", `${imgPrefix}-${++i}.jpg`);
                if (i == 36) i = 0;
            }, 120);
        </script>
<?php
    endif;
endforeach;
?>
<br>
<?php
require_once("footer.php");
?>