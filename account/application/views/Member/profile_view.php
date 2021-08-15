<?php $this->load->view('Layouts/header.php'); ?>
<div class="main-container">
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                <?php $this->load->view('Layouts/aside.php'); ?>
                <div class="col-md-9">
                    <h4>Quản lý Hồ sơ chung</h4>
                    <?php if (mb_strlen($AccountInfo['unlock']) <= 0): ?>
                        <p>Bạn có thể tự do thay đổi thông tin bảo mật Email.</p>
                    <?php else: ?>
                        <p>Thao tác thay đổi thông tin bảo mật Email bị khóa.</p>
                    <?php endif; ?>
                    <br />
                    <div class="row">
                        <div class="col-sm-3">
                            <b><label for="UserName">T&#224;i khoản</label></b>
                        </div>
                        <div class="col-sm-6">
                            <b><?php echo $AccountInfo['cAccName']; ?></b>
                            <hr />
                        </div>
                        <input name="accID" type="hidden" value="<?= $AccountInfo['iid']; ?>" />
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <b><label>Mật khẩu</label></b>
                        </div>
                        <div class="col-sm-6">
                            ******<br /><i>(Đã mã hóa)</i>
                            <hr />
                        </div>
                        <div class="col-sm-3">
                            <a href="<?= base_url('Member/ChangePass') ?>" class="btn btn-sm btn-default btn-block modal-opener">
                                <i class="fa fa-lock"></i> Đổi mật khẩu
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <b><label for="Email">Email</label></b>
                        </div>
                        <div class="col-sm-6">
                            <?php
                                if(empty($AccountInfo['cEMail']))
                                {
                                    echo '(Chưa đăng ký)';
                                    echo '<br>';
                                    echo '<i>(Chưa xác thực)</i>';
                                }
                                elseif(empty($AccountInfo['active_key']) == false && mb_strlen($AccountInfo['active_key']) > 0)
                                {
                                    $len = mb_strlen($AccountInfo['useremail']);
                                    echo '****' . substr($AccountInfo['useremail'], 4, $len);
                                    echo '<br>';
                                    echo '<i>(Chưa xác thực)</i>';
                                }
                                else
                                {
                                    $len = mb_strlen($AccountInfo['cEMail']);
                                    echo '****' . substr($AccountInfo['cEMail'], 4, $len);
                                    echo '<br>';
                                    echo '<i>(Đã xác thực)</i>';
                                }
                            ?>
                            <hr />
                        </div>
                        <div class="col-sm-3">
                            <a href="<?= base_url('Member/ChangeEmail') ?>" class="btn btn-sm btn-default btn-block modal-opener">
                                <i class="fa fa-envelope"></i> Đổi email
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php $this->load->view('Layouts/footer.php'); ?>
