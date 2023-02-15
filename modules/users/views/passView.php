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
                        <a href="" title="">Đổi mật khẩu</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">


        <form method="post" action="?modules=users&controllers=index&action=changePass" name="form-changePass">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Đổi mật khẩu</h1>
                </div>
                <div class="section-detail">

                    <div class="form-row clearfix" style="margin-top: 15px;">
                        <div class="form-col">
                            <!-- <label for="address">Mật khẩu cũ</label> -->
                            <input style="height: 38px;width: 400px;border: 1px solid #cccccc;padding: 6px 12px;"
                                type="password" name="pass_old" id="pass_old" placeholder="Nhập mật khẩu cũ...">
                        </div>
                    </div>

                    <div class="form-row clearfix" style="margin-top: 15px;">
                        <div class="form-col ">
                            <!-- <label for="address">Mật khẩu mới</label> -->
                            <input style="height: 38px;width: 400px;border: 1px solid #cccccc;padding: 6px 12px;"
                                type="password" name="pass_new" id="pass_new" placeholder="Nhập mật khẩu mới...">
                        </div>
                    </div>
                    <div class="form-row clearfix" style="margin-top: 15px;">
                        <div class="form-col">
                            <!-- <label for="address">Nhập lại mật khẩu</label> -->
                            <input style="height: 38px;width: 400px;border: 1px solid #cccccc;padding: 6px 12px;"
                                type="password" name="confirm_pass" id="confirm_pass"
                                placeholder="Nhập lại mật khẩu...">
                        </div>
                    </div>
                    <input type="submit" name="btn_submit" id="btn-submit" value="Cập nhập"
                        style="height: 40px;border-radius: 60px;width: 150px; color: green; border-color: white;color: white;background-color: #48ad48;margin-top: 20px;">
                </div>
            </div>
        </form>

    </div>
</div>

<?php get_footer(); ?>