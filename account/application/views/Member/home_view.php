<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <?php $this->load->view('Layouts/aside.php'); ?>
                            <div class="col-md-9">
                                <?php
                                    if ($accountStatus == 'safety')
                                    {
                                        $class = 'success';
                                        $message = 'Tài khoản của bạn hiện đang ở trạng thái <strong>Khóa An Toàn</strong>. <br />
                                                    Thao tác thay đổi thông tin bảo mật Email bị khóa.';
                                        $button = '<a href="'.base_url('Member/UserUnlock').'" class="btn btn-sm btn-default modal-opener"><i class="fa fa-lock"></i> Mở Khóa Tài Khoản</a>';
                                    }
                                    elseif ($accountStatus == 'notVerify')
                                    {
                                        $class = 'danger';
                                        $message = 'Cảnh báo: Tài khoản của bạn chưa thiết lập Email.<br />
                                                    Hãy nhấn Xem Hồ Sơ và tiến hành xác thực để đảm bảo an toàn.';
                                        $button = '<a href="'. base_url('Member/Profile') .'" class="btn btn-sm btn-default"><i class="fa fa-file-text"></i> Xem Hồ Sơ</a>';
                                    }
                                    else
                                    {
                                        $class = 'warning';
                                        $message = 'Tài khoản của bạn hiện đang ở trạng thái <strong>Mở Khóa</strong>. <br/>
                                                    Bạn có thể tự do thay đổi các thông tin bảo mật Email bị khóa';
                                        $button = '<a href="'.base_url('Member/UserLockNow').'" class="btn btn-sm btn-default modal-opener"><i class="fa fa-lock"></i> Khóa Tài Khoản</a>';

                                    }
                                ?>
                                <div class="alert alert-<?= $class ?>">
                                    <button data-dismiss="alert" class="close" type="button">×</button>
                                    <?= $message ?>
                                    <p class="text-center">
                                        <br />
                                        <?= $button ?>
                                    </p>
                                </div>
                                <div class="row grid-space-10">
                                    <div class="col-sm-6">
                                        <div class="box-style-2">
                                            <div class="icon-container default-bg">
                                                <a href="<?= base_url('Member/Profile') ?>"><i class="fa fa-file-text"></i></a>
                                            </div>
                                            <div class="body">
                                                <h2>Hồ sơ</h2>
                                                <p>Quản lý thông tin mật khẩu, email, mật khẩu rương...</p>
                                                <a href="<?= base_url('Member/Profile') ?>" class="link"><span>Xem thêm</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box-style-2">
                                            <div class="icon-container default-bg">
                                                <a href="<?= base_url('Member/Character') ?>"><i class="fa fa-user-plus"></i></a>
                                            </div>
                                            <div class="body">
                                                <h2>Nhân vật</h2>
                                                <p>Xem thông tin nhân vật</p>
                                                <a href="<?= base_url('Member/Character') ?>" class="link"><span>Xem thêm</span></a>
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
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
