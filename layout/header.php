<!DOCTYPE html>
<html>

<head>
    <title>LOCAL STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="#" title="" id="payment-link" class="fl-left">Hình thức
                            thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">

                                <li>
                                    <a href="?modules=blogs&action=list" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="?modules=contacts&action=contact" title="">Liên hệ</a>
                                </li>
                                <li>
                                    <?php
                                    if (empty($_SESSION['fullname'])){
                                        echo '<a href="?modules=users&action=index" title="">Đăng nhập</a>
                                        </li>';
                                    } else{
                                        echo '<div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="true">
                                            <div id="thumb-circle" class="fl-left"
                                                style="border-radius: 100px; background-color: white;margin-top: 12px;">
                                                <img style="max-width: 22px; max-height: 22px;border-radius: 45px;"
                                                    src="public/images/user.png">
                                            </div>
                                        </button>
                                        <ul class="dropdown-menu" style="left: inherit;right: 10px;margin-top: 10px;">
                                            <li><a href="?modules=users&controller=index&action=information"
                                                    title="Thông tin cá nhân" style = "padding: 5px 20px;color: #2b2b2b;width: 158px;">Thông
                                                    tin tài khoản</a></li>
                                                    <li><a href="?modules=users&controller=index&action=pass"
                                                    title="Đổi mật khẩu" style = "padding: 5px 20px;color: #2b2b2b;width: 158px;">Đổi mật khẩu</a></li>
                                            <li><a href="?modules=users&action=logout"
                                                    title="Đăng xuất" style = "padding: 5px 20px;color: #2b2b2b;width: 158px;">Đăng xuất</a></li>
                                        </ul>
                                    </div>
                                </li>';
                                    }
                                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?modules=home" title="" id="logo" class="fl-left"><img
                                src="public/images/logoPC.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="post" action="?modules=search&controllers=index&action=search">
                                <input type="text" name="key_word" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <input type="submit" id="sm-s" name="btn_submit" value="Tìm kiếm">

                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">1900.1508</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?modules=carts&action=show" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">
                                        <?php if (isset($_SESSION['cart']['buy']) && !empty($_SESSION['id_customer']))
                                            echo $_SESSION['cart']['info']['num_oder'];
                                        else
                                            echo '0'; ?>
                                    </span>
                                </div>
                                <div id="dropdown">
                                    <!-- giỏ hang -->
                                    <p class="desc">Có <span>
                                            <?php if (isset($_SESSION['cart']['buy']) && !empty($_SESSION['id_customer']))
                                                echo $_SESSION['cart']['info']['num_oder'];
                                            else
                                                echo '0'; ?>
                                            sản phẩm
                                        </span> trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        <?php if (isset($_SESSION['cart']['buy']) && !empty($_SESSION['id_customer'])) { ?>
                                        <?php foreach ($_SESSION['cart']['buy'] as $key => $value) { ?>
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="<?php echo $value['image']; ?>" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title="" class="product-name">
                                                    <?php echo $value['name']; ?>
                                                </a>
                                                <p class="price">
                                                    <?php echo format_currency($value['price']). ' .VNĐ'; ?>
                                                </p>
                                                <p class="qty">Số lượng: <span>
                                                        <?php echo $value['qty']; ?>
                                                    </span></p>
                                            </div>
                                        </li>
                                        <?php }
                                        }
                                        ; ?>
                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">
                                            <?php if (isset($_SESSION['cart']['buy']) && !empty($_SESSION['id_customer']))
                                                echo format_currency($_SESSION['cart']['info']['total']). " .VNĐ";
                                            else
                                                echo "0 .VNĐ"; ?>
                                        </p>
                                    </div>
                                    <dic class="action-cart clearfix">
                                        <a href="?modules=carts&action=show" title="Giỏ hàng"
                                            class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="?modules=checkouts&action=index" title="Thanh toán"
                                            class="checkout fl-right">Thanh toán</a>
                                    </dic>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>