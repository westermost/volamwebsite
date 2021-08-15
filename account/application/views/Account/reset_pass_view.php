<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <div class="form-block center-block">
                        <h2 class="title"><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Đặt lại mật khẩu</h2>
                        <hr />
                        <form action="<?= base_url('Account/ResetPass') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
                            <input data-val="true" data-val-length="Tài khoản phải có tối thiểu 3 ký tự." data-val-length-max="32" data-val-length-min="3" data-val-required="Tài khoản không được để trống" id="UserName" name="UserName" type="hidden" value="<?= $userName ?>" />
                            <input data-val="true" data-val-required="Mã số (từ Email) không được để trống" id="Code" name="Code" type="hidden" value="<?= $code ?>" />
                            <div id="formMessage" class="alert alert-danger hidden"></div>
                            <div class="form-group has-feedback">
                                <label class="col-sm-3 control-label" for="Password">Mật khẩu mới</label>
                                <div class="col-sm-8">
                                    <input class="form-control" data-val="true" data-val-length="Mật khẩu mới phải có tối thiểu 6 ký tự." data-val-length-max="60" data-val-length-min="6" data-val-required="Mật khẩu mới không được để trống" id="Password" maxlength="60" name="Password" placeholder="New Password" type="password" />
                                    <i class="fa fa-lock form-control-feedback"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label class="col-sm-3 control-label" for="ConfirmPassword">X&#225;c nhận</label>
                                <div class="col-sm-8">
                                    <input class="form-control" data-val="true" data-val-equalto="Mật khẩu và Xác nhận không khớp." data-val-equalto-other="*.Password" id="ConfirmPassword" maxlength="60" name="ConfirmPassword" placeholder="Confirm Password" type="password" />
                                    <i class="fa fa-lock form-control-feedback"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label class="col-sm-3 control-label">Nhập hình</label>
                                <div class="col-sm-8">
                                    <img id="captchaImg" src="<?= base_url('Home/Captcha') ?>" alt="Captcha Image" />
                                    <input class="form-control" id="captcha" maxlength="5" name="captcha" placeholder="Captcha Image" type="text" value="" />
                                    <i class="fa fa-check form-control-feedback"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8 text-center">
                                    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-lock"></i>&nbsp;&nbsp;<b>XÁC NHẬN</b></button>
                                    <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
