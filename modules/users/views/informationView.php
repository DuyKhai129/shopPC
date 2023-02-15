<?php get_header(); ?>



<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thông tin tài khoản</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">

        <form method="post" action="?modules=users&controllers=index&action=changeInformation"
            name="form-changeInformation">
            <?php if(!empty($data)) foreach ($data as  $value) {?>
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin cá nhân</h1>
                </div>
                <div class="section-detail">

                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="username">tên đăng nhập</label>
                            <input type="text" name="username" readonly="readonly" id="username"
                                value="<?php echo $value['username']; ?>">
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="mail" placeholder="Nhập email..." id="email"
                                value="<?php echo $value['mail']; ?>">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" placeholder="Nhập tên..." id="fullname"
                                value="<?php echo $value['fullname']; ?>">
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" placeholder="Nhập phone..."
                                value="<?php echo $value['phone']; ?>">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <textarea name="address"><?php echo $value['address']; ?></textarea>
                        </div>
                    </div>

                    <?php }; ?>

                    <input type="submit" name="btn_submit" id="btn-submit" value="Cập nhật"
                        style="height: 40px;border-radius: 60px;width: 150px;color: green; border-color: white;color: white; background-color: #48ad48;">
                </div>
            </div>
        </form>


    </div>
</div>

<?php get_footer(); ?>