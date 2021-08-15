<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <div class="form-block center-block">
                        <h2 class="title"><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Mở Khóa Tài Khoản</h2>
                        <hr />
                        <div class="text-center">
                            <?php  if ($active == 'success'):  ?>
                                <div class="alert alert-success">
                                    Đã mở khóa tài khoản thành công.
                                </div>
                                <hr />
                                <p>
                                    <a class="btn btn-primary" href="<?= base_url('Member') ?>"><i class="fa fa-check"></i> Đồng ý</a>
                                </p>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <?php echo $checkFlg; ?>
                                    Hệ thống không thể xác minh địa chỉ email, xin hãy kiểm tra lại 1111.
                                </div>
                                <hr />
                                <p>
                                    <a class="btn btn-primary" href="<?= base_url('Member') ?>"><i class="fa fa-check"></i> Đồng ý</a>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>




