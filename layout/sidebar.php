<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                <li>
                    <a href="?modules=products&controllers=index&action=show&id_cat=13" title="">PC</a>
                </li>
                <li>
                    <a href="?modules=products&controllers=index&action=show&id_cat=14" title="">Máy Tính
                        Bảng</a>
                </li>
                <li>
                    <a href="?modules=products&controllers=index&action=show&id_cat=12" title="">Lap Top</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">

                <?php if(!empty($_SESSION['product_hot'])){ $i=0; foreach ($_SESSION['product_hot'] as  $value) {?>
                <?php $i++; if($i>9) break; ?>
                <li class="clearfix">
                    <a href="?modules=products&controllers=index&action=detail&id=<?php echo $value['id']; ?>" title=""
                        class="thumb fl-left">
                        <img src="<?php echo $value['image']; ?>" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?modules=products&controllers=index&action=detail&id=<?php echo $value['id']; ?>"
                            title="" class="product-name"><?php echo $value['name']; ?></a>
                        <div class="price">
                            <span style="display: block;"
                                class="new"><?php echo format_currency($value['promotional_price']).' VNĐ'; ?></span>
                            <span style="display: block;"
                                class="old"><?php echo format_currency($value['price']).' .VNĐ'; ?></span>
                        </div>
                        <a href="<?php $id = $value['id']; if(!empty($_SESSION['id_customer'])) $urlll ="?modules=carts&controllers=index&action=addByNow&id=$id"; else $urlll ="?modules=users&controllers=index&action=index&report=1" ;echo $urlll;?> "
                            title="" class="buy-now"
                            style="color: #da1818;border: 1px solid #da1818;border-radius: 5px;width: 74px;text-align: center;">
                            Mua ngay</a>
                    </div>
                </li>
                <?php }}; ?>

            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="#" title="" class="thumb">
                <img src="public/images/banner0.jpg" alt="No">
            </a>


        </div>
    </div>
</div>